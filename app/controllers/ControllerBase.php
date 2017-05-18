<?php

use Phalcon\Mvc\Controller;

/**
 *
 * @author Julián Arturo Molina Castiblanco
 * @version 0.1
 * @copyright Logisticapp.sa
 */
class ControllerBase extends Controller
{

	const SUCCESS = 200;
    const FAILED = 409;
    const EMPTYFIELD = "*";
    const WARNING_MESSAGE = "WARNING OPERATION";
    const FAILED_MESSAGE = "FAILED OPERATION";
    const NOTICE_MESSAGE = "NOTICE MESSAGE";
    const SUCCESS_MESSAGE = "SUCCESS OPERATION";

    protected $_authData = null;
    protected $_dateTime = null;

	/**
	 * Google GCM and ApplePush
	 */
	protected $uuid;
	protected $title;
	protected $body;
	protected $data;
	protected $type;
	protected $typeDevice = 1;

    /**
     *
     */
    public function initialize()
    {
        $this->_dateTime = new \DateTime();
    }

	/**
     * Send Http JSON response
     */
    public function setJsonResponse($code, $msj, array $content)
    {
        $this->response->setStatusCode($code, $msj);
        $this->response->setJsonContent($content);
        $this->response->send();
    }

    /**
     * Store trace to error models.
     */
    protected function _checkError($model)
    {
        if ($model) {

            $errors = array();
            foreach ($model->getMessages() as $msg) {
                $errors[] = $msg;
            }
            return $errors;

        } else {
            return false;
        }
    }

    /**
     * Check if parameters are valid fields.
     *
     * @param Array $_POST $compare
     * @param
     */
    protected function _checkFields($dataRequest, array $fields, array $optional = array(), $method = "POST", $itemHead = 0)
    {

        $dataRequest = (array) $dataRequest;
        $check[] = array();
        $error = array();

        $i = 1;
        $item = null;
        foreach ($fields as $key => $value) {

            $rest = array_key_exists($value, $dataRequest);

            if ($rest) {

            } else {

                $check[] = "false";
                $error[] = empty($value) ? "" : $value;
                $item[] = $i;

            }
            $i++;
        }

        $item = $itemHead > 0 ? $itemHead : $item;

        if (array_search("false", $check)) {

            $this->setJsonResponse(self::SUCCESS, "CHECK FIELDS PARAMETER ERROR", array(
                "return" => false,
                "item" => $item,
                "messages" => array("This parameters are wrong" => array_unique($error)),
                "optiona_fields" => $optional,
                "status" => self::FAILED
            ));
            return false;

        } else {
            return true;
        }
    }

    /**
	 *
	 */
	public function sendPush($solicitudes, $sender)
	{

		if (isset($solicitudes->ClienteRemitente->id_cliente) and $sender != 1) {
			$this->setUuid($solicitudes->ClienteRemitente->gcm_id);
			$this->platformPush($solicitudes->ClienteRemitente->plataforma);
		}

		if (isset($solicitudes->ClienteReceptor->id_cliente) and $sender != 2) {
			$this->setUuid($solicitudes->ClienteReceptor->gcm_id);
			$this->platformPush($solicitudes->ClienteReceptor->plataforma);
		}

		if (isset($solicitudes->RecursoLogistico->id_recurso_logistico) and $sender != 3) {
			$this->setUuid($solicitudes->RecursoLogistico->gcm_id);
			$this->setTypeDevice(2); //2 = Mensajero, 1 = Cliente android
			$this->platformPush("android");
		}

	}

	public function platformPush($platform)
	{
		if (strtolower($platform) == "ios") {
			$this->sendApplePush();
		} else if(strtolower($platform) == "android") {
			$this->sendAndroidPush();
		} else if(strtolower($platform) == "web") {

            $this->pusher->trigger($this->getUuid(), 'my_event', array(
                "title" => $this->getTitle(),
                "body" => $this->getBody(),
                "data" => $this->getData()
            ));
        }
	}

	/**
	 *
	 */
	public function sendApplePush()
	{
		$apple = new ApplePushNotify();
		$apple->send(
			$this->getUuid(),
			$this->getTitle(),
			$this->getType(),
			$this->getData(),
			array(
				"title" => $this->getTitle(),
				"body" => $this->getBody()
			)
		);
	}

	/**
	 *
	 */
	public function sendAndroidPush()
	{
		$google = new GoogleCloudMessage();
		$google->setDevices(array($this->getUuid()));
		$result = $google->send(json_encode(array_filter(array(
			"title" => $this->getTitle(),
			"body" => $this->getBody(),
			"data" => $this->getData(),
			"type" => $this->getType()
		))), $this->getTypeDevice());
	}

	/**
     * Check if key is empty or null from post data recieve
     *
     */
    protected function _validKey($method = "POST")
    {

        if ($method == "POST")
            $dataRequest = $this->request->getJsonPost();
        else
            $dataRequest = $this->request->getJsonRawBody();

        if (isset($dataRequest->key)) {

            $this->_authData = Platform::findFirst(array(
                "conditions" => "key = ?1",
                "bind" => array(1 => $dataRequest->key),
            ));

            if ($this->_authData) {

                return true;

            } else {

                $this->setJsonResponse(ControllerBase::SUCCESS, ControllerBase::FAILED_MESSAGE, array(
                    "return" => false,
                    "message" => "Key not found",
                    "status" => ControllerBase::FAILED
                ));

                return false;
            }

        } else {

            $this->setJsonResponse(ControllerBase::SUCCESS, ControllerBase::FAILED_MESSAGE, array(
                "return" => false,
                "message" => "Key parameter is empty",
                "status" => ControllerBase::FAILED
            ));

            return false;

        }
    }

	public function setTitle($title)
	{
		$this->title = $title;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setBody($body)
	{
		$this->body = $body;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}

	public function setTypeDevice($type)
	{
		$this->typeDevice = $type;
	}

	public function getTypeDevice()
	{
		return $this->typeDevice;
	}

}

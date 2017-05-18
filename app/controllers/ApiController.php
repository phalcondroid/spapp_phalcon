<?php

/**
 *
 * @author Julián Arturo Molina Castiblanco <b>phalcondroid@gmail.com</b>
 * @version 1.0 <b>Enero 2016</b>
 *
 */
class ApiController extends ControllerBase
{

    /**
     *
     */
    public function newrequestAction()
    {

    	$this->request->getJsonPost();

    	$data = array(
    		"key_access",
    		"platform"
    	);

    }

    /**
     *
     */
    public function quotationAction()
    {
        $dataRequest = $this->request->getJsonPost();
        $fields = array(
            "key",
            "time",
            "service_category_id",
            "platform"
        );

        if ($this->_checkFields($dataRequest, $fields)) {

            if ($this->_validKey()) {

            }
        }
    }

    /**
     *
     */
    public function generalAction()
    {

    	$dataRequest = $this->request->getJsonPost();
    	$fields = array(
    		"key",
    		"platform"
    	);

    	if ($this->_checkFields($dataRequest, $fields)) {

            if ($this->_validKey()) {
            	$services = Service::find();
            	$return = array();
                $categories = array();

            	foreach ($services as $item) {

                    $categories = array();

                    foreach ($item->ServiceCategory as $item2) {
                        $categories[] = array(
                            "id" => $item->getId(),
                            "name" => utf8_encode($item2->getName()),
                            "description" => utf8_encode($item2->getDescription()),
                            "image" => $item2->getImage(),
                            "video" => $item2->getVideo()
                        );
                    }

            		$return[] = array(
            			"id" => $item->getId(),
            			"name" => utf8_encode($item->getName()),
            			"description" => utf8_encode($item->getDescription()),
            			"image" => $item->getImage(),
                        "categories" => $categories
            		);
            	}

            	$this->setJsonResponse(ControllerBase::SUCCESS, ControllerBase::FAILED_MESSAGE, array(
                    "status" => $this->strings->getString("http", "success"),
                    "message" => $this->strings->getString("platform", "success"),
                    "data" => $return
                ));
            }
        }
        return $this->response;
    }

    /**
     *
     */
    public function register_user_informationAction()
    {

    	$dataRequest = $this->request->getJsonPost();
    	$fields = array(
      	  "key",
      		"name",
      		"last_name",
      		"email",
      		"image",
      		"phone",
      		"uuid",
      		"platform"
    	);

    	if ($this->_checkFields($dataRequest, $fields)) {

            if ($this->_validKey()) {

            	$user = new User();
                $user->setName($dataRequest->name);
                $user->setLastName($dataRequest->last_name);
                $user->setEmail($dataRequest->email);
                $user->setImage($dataRequest->image);
                $user->setPhone($dataRequest->phone);
                $user->setUuid($dataRequest->uuid);
                $user->setPlatform($dataRequest->platform);
                $user->setSession(true);
                $user->setFirstConnection($this->_dateTime->format("Y-m-d H:m:s"));
                $user->setLastConnection($this->_dateTime->format("Y-m-d H:m:s"));
                $user->setStatus(1);

                if ($user->save()) {

                    $this->setJsonResponse(ControllerBase::SUCCESS, ControllerBase::FAILED_MESSAGE, array(
                        "status" => $this->strings->getString("http", "success"),
                        "message" => $this->strings->getString("user", "insert_success"),
                        "data" => array(
                            "user_id" => $user->getIdUser()
                        )
                    ));

                } else {

                    $this->setJsonResponse(ControllerBase::SUCCESS, ControllerBase::FAILED_MESSAGE, array(
                        "status" => $this->strings->getString("http", "error"),
                        "message" => $this->_checkError($user),
                        "data" => $return
                    ));

                }
            }
        }
    }
}

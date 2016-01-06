<?php

/**
 * 
 */
class ApiController extends ControllerBase
{

	/**
	 * 
	 */
    public function registerdataAction()
    {

    }

    /**
     * 
     */
    public function new_requestAction()
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

            	foreach ($services as $item) {

            		$return[] = array(
            			"id" => $item->getId(),
            			"name" => utf8_encode($item->getName()),
            			"description" => utf8_encode($item->getDescription()),
            			"image" => $item->getImage()
            		);
            	}

            	$this->setJsonResponse(ControllerBase::SUCCESS, ControllerBase::FAILED_MESSAGE, array(
                    "status" => $this->strings->getString("http", "success"),
                    "message" => $this->strings->getString("platform", "success"),
                    "data" => $return
                ));
            }
        }
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
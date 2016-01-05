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
}
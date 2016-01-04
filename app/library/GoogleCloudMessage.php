<?php

/**
 *
 */
class GoogleCloudMessage
{
	
    private $url = 'https://android.googleapis.com/gcm/send';
	private $clientApiKey = "AIzaSyCwqQA2RSSghjtKpvC6wOTbjTIjKUcDkwM";
    private $providerApiKey = "AIzaSyC5DyBB5z-X5unHlUe1HA9yVoy1o7qGdFc";
    private $serverApiKey;
	private $devices = array();
	private $di;

    public function __construct($apiKey = "")
    {
        if (!empty($apiKey)) {
            $this->serverApiKey = $apiKey;
        }
    }

	/**
	 *	Set the devices to send to
	 *	@param $deviceIds array of device tokens to send to
	 */
	public function setDevices($deviceIds)
    {
		if (is_array($deviceIds)) {
			$this->devices = $deviceIds;
		} else {
			$this->devices = array($deviceIds);
		}
	}
	/**
	 *	Send the message to the device
	 *	@param $message The message to send
	 *	@param $data Array of data to accompany the message
	 */
	public function send($message, $typeApi = 1)
    {

		if (!is_array($this->devices) || count($this->devices) == 0) {
			$this->error("No devices set");
		}

		$fields = array(
			'registration_ids'  => $this->devices,
			'data'              => array( "message" => $message ),
		);

        if ($typeApi == 1) {
            $this->serverApiKey = $this->clientApiKey;
        } else {
            $this->serverApiKey = $this->providerApiKey;
        }

		$headers = array(
			'Authorization: key=' . $this->serverApiKey,
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $this->url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ));
		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);

		// Execute post
		$result = curl_exec($ch);

		// Close connection
		curl_close($ch);

		return $result;
	}

	function error($msg){
		//echo "Android send notification failed with error:";
		//echo "\t" . $msg;
		//echo $this->serverApiKey. " - ", print_r($this->devices);
		exit(1);
	}

	public function setDi($di)
	{
		$this->di = $di;
	}
}

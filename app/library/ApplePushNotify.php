<?php

/**
 * 
 */
class ApplePushNotify 
{

	private $socketClientDev = 'ssl://gateway.sandbox.push.apple.com:2195';
	private $socketClientProd = 'ssl://gateway.push.apple.com:2195';
	private $_socketClient = null;
	private $passphrase = 'Logisticapp';
	private $deviceToken = null;

	public function __construct($socket = "dev")
	{
		if ($socket == "dev") {
			$this->_socketClient = $this->socketClientDev;
		} else {
			$this->_socketClient = $this->socketClientProd;
		}
	}

	/**
	 * 
	 */
	public function send($token, $message, $type, $data = "", $content = "")
	{

		if (!empty($token) and !empty($message)) {

			try {

				$this->errorHandler();

				$ctx = stream_context_create();
				stream_context_set_option($ctx, 'ssl', 'local_cert', dirname(__FILE__) . '/dev.pem');
				stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passphrase);

				// Open a connection to the APNS server
				$fp = stream_socket_client(
							$this->_socketClient,
							$err,
							$errstr, 
							60, 
							STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, 
							$ctx
				);

				if (!$fp)
					exit("Failed to connect: $err $errstr" . PHP_EOL);

				// Create the payload body
				$body['aps'] = array(
					'alert' => $message . " ",
					"type" => $type . " ",
					"message" => $content,
					"data" => $data
				);

				// Encode the payload as JSON
				$payload = json_encode($body);

				// Build the binary notification
				$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;

				// Send it to the server
				$result = fwrite($fp, $msg, strlen($msg));

				// Close the connection to the server
				fclose($fp);

				if (!$result)
					return true;
				else
					return false;

			} catch (Exception $e) {
				return false;
			}
		}
	}

	public function errorHandler()
	{
		/**
		 * Become all warning and notice in throw exception
		 */
		set_error_handler(function($num, $str, $file, $line, $context = null)
		{
		    throw new \ErrorException($str, 0, $num, $file, $line);
		});
	}
}
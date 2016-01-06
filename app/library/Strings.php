<?php

class Strings
{

	public function getString($title, $string)
	{
		if (empty($string)) {
			return false;
		} else {
			$list = (new ListString())->getList();
			return $list[$title][$string];
		}
	}
}

class ListString
{
	public function getList()
	{
		return array(
			"http" => array(
				"success" => 200,
				"not_found" => 404,
				"server_error" => 503
			),
			"platform" => array(
				"success" => "Datos de servicios"
			),
			"params" => array(
				"wrong" => "Los parámetros son incorrectos"
			),
			"user" => array(
				"insert_success" => "insert ok",
				"insert_error" => "Insert error",
				"not_found" => "User not found"
			) 
		);
	}
}
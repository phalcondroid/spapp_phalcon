<?php

/**
 * 
 */
class TestController extends ControllerBase
{
	public function indexAction()
	{
		$alert = "Registrado correctamente";
		$msj = "";
		$i = 0;
		foreach ($this->request->getPost() as $item) {
			if (empty($item)) {
					switch ($i) {
						case 0:
								$msj = "El campo nombres: ";
							break;
						case 1:
								$msj = "El campo apellidos: ";
							break;
						case 2:
								$msj = "El campo email: ";
							break;
						case 3:
								$msj = "El campo teléfono: ";
							break;
						case 4:
								$msj = "El campo password: ";
							break;
						case 1:
								$msj = "El campo recordar: ";
							break;
					}
					$alert = $msj . " es incorrecto o está vacío.";
				break;
			}
			$i++;
		}

		if ($this->request->isPost()) {
			echo "<div class='alert alert-warning' role='alert'>$alert</div>";
		}
	}
}
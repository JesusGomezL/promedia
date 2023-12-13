<?php
$nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '[Sin nombre]';
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '[Sin e-mail]';
$telefono = isset($_REQUEST['telefono']) ? $_REQUEST['telefono'] : '[Sin teléfono]';
$asunto = isset($_REQUEST['asunto']) ? $_REQUEST['asunto'] : '[Sin asunto]';
$comentarios = isset($_REQUEST['comentarios']) ? $_REQUEST['comentarios'] : '[Sin comentarios]';;

// FUNCIONES

function sanear_input ($s){
	$s = filter_var ($s, FILTER_SANITIZE_SPECIAL_CHARS);
	//
	return ($s);
}

function validar_email ($s){
	if (!filter_var ($s, FILTER_VALIDATE_EMAIL))
		{return (false);}
	else
		{
			$s = sanear_input ($s);
			//
			return ($s);
		}
	//
	return ($s);
}

// PROGRAMA

$nombre = sanear_input ($nombre);
$email = validar_email ($email);
$telefono = sanear_input ($telefono);
$asunto = sanear_input ($asunto);
$comentarios = sanear_input ($comentarios);
//
require_once ('cnx.php');
//
crear_conexion ('promedia');
//
$cnx = conectar();
//
$s = 'INSERT INTO contactos (nombre, email, telefono, asunto, comentarios) VALUES ("' . $nombre . '", "' . $email . '", "' . $telefono . '", "' . $asunto . '", "' . $comentarios . '")';
$res = query ($cnx, $s);		
//
desconectar ($cnx);
//

$r = new StdClass;
$r->res = 'ok';
$json = json_encode($r);

echo ($json);

?>


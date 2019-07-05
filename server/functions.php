<?php
require 'core/db.php';

include 'core/conf_email.php';

include 'image.php';

$response = array();

if (isset($_POST)) {
    $email = strip_tags($_POST['email']);
    $nombre = ucwords(strip_tags($_POST['nombre']));
    $apellido = ucwords(strip_tags($_POST['apellido']));
    $dpi = strip_tags($_POST['dpi']);
    $telefono = strip_tags($_POST['telefono']);
    $code = strip_tags($_POST['code']);

    $encrypt_code = md5($dpi);

    $spGetCode = callsp("sp_getCode", array('code'), array('code' => $code));
    if ($spGetCode[0]['error'] == 1) {
        $response['error'] = true;
        $response['message'] = 'Ocurio un error al guardar tus datos, intenta mas tarde.';
    } elseif ($spGetCode[0]['error'] == 2) {
        $response['error'] = true;
        $response['message'] = 'Este codigo ya ha sido registrado para otro usuario.';
    } elseif ($spGetCode[0]['error'] == 3) {
        $response['error'] = true;
        $response['message'] = 'El codigo ingresado no existe o no es valido.';
    } else {

        $data = array(
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'dpi' => $dpi,
            'telefono' => $telefono,
            'idCode' => $spGetCode[0]['idCode'],
            'encrypt_code' => $encrypt_code
        );
        $parameters = array('nombre', 'apellido', 'email', 'dpi', 'telefono', 'idCode', 'encrypt_code');
        $sp_saveCode = callsp("sp_saveCode", $parameters, $data);
        if ($sp_saveCode[0]['error'] == 1) {
            $response['error'] = true;
            $response['message'] = 'Ocurio un error al guardar tus datos, intenta mas tarde.';
        } else if ($sp_saveCode[0]['error'] == 2) {
            $response['error'] = true;
            $response['message'] = 'Este codigo ya ha sido registrado para otro usuario.';
        } else {

            writeInvitation($dpi, $nombre . ' ' . $apellido);

            $subject = "Confirmaci¨®n invitaci¨®n - Heineken F1";
            $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
					<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
					
					<title>Heineken| Invitaciones</title>
					</head>
					<body> 
				    <a href="https://waze.to/lr/h9fxdu437f" target="_blank"><img style = "margin: 0 auto; display: block; width:100%; max-width:768px;" src="https://finalheineken.com/server/qr-codes/invitation-' . $encrypt_code . '.png"/></a>  
				</body>
				</html>';
            $fromEmail = 'no-reply@finalheineken.com';
            $cabeceras = 'From:' . $fromEmail . "\r\n" .
                'Reply-To:' . $fromEmail . "\r\n" .
                'X-Mailer: PHP/' . phpversion() .
                'Return-Path:' . $fromEmail . "\r\n" .
                'MIME-Version: 1.0' . "\r\n" .
                'Content-type: text/html; charset="UTF-8"' . "\r\n";

            mail($email, $subject, $message, $cabeceras);

            $response['error'] = false;
            $response['message'] = 'Guardo exitosamente.';
        }
    }
} else {
    $response['error'] = true;
    $response['message'] = 'No hay data POST.';
}
echo json_encode($response);
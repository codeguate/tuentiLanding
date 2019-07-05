<?php

require 'core/rb-mysql.php';
R::setup('mysql:host=localhost;dbname=codeguat_heineken-form', 'codeguat_hkform', 'hkform2016', true);
$response = [];
if (isset($_POST)) {
    $encrypt_code = strip_tags($_POST['d']);
    $function = strip_tags($_POST['function']);
    $usuario = end(R::find('usuario', ' encrypt_code = ? ', [$encrypt_code]));
    if($function == 0){
        if($usuario['estado'] == "1"){
            $response['error'] = true;
            $response['data'] = $usuario->export();
            $response['message'] = 'Esta invitacion ya fue activada';
            echo json_encode($response);
            exit(0);
        }
        $response['error'] = false;
        $response['data'] = $usuario->export();
        echo json_encode($response);
        exit(0);
    }elseif ($usuario['estado'] == "0" && $function == 1){
        $usuario['estado'] = "1";
        R::store($usuario);
    }
    $response['error'] = false;
    $response['data'] = $usuario->export();
}
echo json_encode($response);
exit(0);
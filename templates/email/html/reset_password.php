<?php

use Cake\Routing\Router;

// Creating message
$url = Router::url([
    'controller' => 'users',
    'action' => 'resetPassword',
    $user->token
], true);

$message = '<p>Apreciado(a) ' . $user->first_name . ', hemos recibido tu solicitud para restaurar la contraseña de tu cuenta. Para realizar el cambio haz clic en el siguiente enlace: </p>';
$message .= '<a href=' . $url . '>Restablecer contraseña</a>';

echo $message;

<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class UserMailer extends Mailer
{
    public function resetPassword($user)
    {
        return $this // Returning the chain is a good idea :)
            ->setFrom(['soporte@innovaciones.co' => 'Soporte Exea Media'])
            ->setTo($user->email)
            ->setSubject('Exea Media - Restaurar contraseña')
            ->setViewVars(['user' => $user]);
    }
}

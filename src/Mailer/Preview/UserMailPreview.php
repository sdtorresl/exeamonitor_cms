<?php
// Create the file src/Mailer/Preview/UserMailPreview.php
namespace App\Mailer\Preview;

use DebugKit\Mailer\MailPreview;

class UserMailPreview extends MailPreview
{
    public function resetPassword()
    {
        $this->loadModel("Users");
        $user = $this->Users->find()->first();
        return $this->getMailer("User")
            ->resetPassword($user);
    }
}

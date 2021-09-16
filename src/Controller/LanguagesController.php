<?php

namespace App\Controller;

use PhpParser\Node\Expr\Cast\String_;

/**
 * Languages Controller
 *
 */
class LanguagesController extends AppController
{
    /**
     * English method
     *
     * @return \Cake\Http\Response|null|void Redirect
     */
    public function en()
    {
        $this->changeLanguage('en');
    }

    /**
     * Spanish method
     *
     * @return \Cake\Http\Response|null|void Redirect
     */
    public function es()
    {
        $this->changeLanguage('es');
    }

    private function changeLanguage(string $lang)
    {
        $session = $this->getRequest()->getSession();
        $session->write('Config.language', $lang);
        $this->redirect($this->referer());
    }
}

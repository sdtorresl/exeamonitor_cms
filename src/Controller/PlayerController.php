<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Component\DataParams;


/**
 * Player Controller
 *
 *
 * @method \App\Model\Entity\Check[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayerController extends AppController
{

    public function initialize(): void
    {
        parent::initialize();
        $url = env('AMPACHE_HOST', 'localhost') . ':' .  env('AMPACHE_PORT', '80');;
        $user = env('AMPACHE_USER', 'admin');
        $pass = env('AMPACHE_PASS', 'admin');
        //$this->ampacheClient = AmpacheClient::getclient($url, $user, $pass, 'xml');
        $this->loadComponent('Ampache', [
            'url' => $url,
            'user' => $user,
            'pass' => $pass,
            'type' => 'xml'
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $this->set('response', $this->Ampache->handshake());
        $this->set('songs', $this->Ampache->getSongs(new DataParams()));
        $this->set('song', $this->Ampache->getSong(21));
    }
}

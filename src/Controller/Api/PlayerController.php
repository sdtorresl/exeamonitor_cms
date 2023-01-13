<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Component\DataParams;
use App\Controller\Api\Utils\ErrorResponse;

/**
 * Player Controller
 *
 *
 * @method \App\Model\Entity\Check[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayerController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'songs', 'song', 'playlists', 'playlist']);
    }

    public function initialize(): void
    {
        parent::initialize();
        $url = env('AMPACHE_HOST', 'ampache') . ':' .  env('AMPACHE_PORT', '80');;
        $user = env('AMPACHE_USER', 'admin');
        $pass = env('AMPACHE_PASS', 'admin');

        $this->loadComponent('Ampache', [
            'url' => $url,
            'user' => $user,
            'pass' => $pass,
            'type' => 'json'
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
        $this->set('data', $this->Ampache->handshake());
        $this->viewBuilder()->setOption('serialize', ['data']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function playlists()
    {
        $this->Authorization->skipAuthorization();
        $this->set('data', $this->Ampache->getPlaylists(new DataParams())->playlist);
        $this->viewBuilder()->setOption('serialize', 'data');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function playlist($uid = null)
    {
        $this->Authorization->skipAuthorization();

        $playlist = $this->Ampache->getPlaylist($uid);
        if ($playlist) {
            $this->set('data', $playlist);
            $this->viewBuilder()->setOption('serialize', ['data', 'message']);
        } else {
            $errorResponse = new ErrorResponse('Not found', 404);
            return $errorResponse->getResponse($this->response);
        }
    }

    /**
     * Get songs method
     *
     * @return \Cake\Http\Response|null
     */
    public function songs()
    {
        $this->Authorization->skipAuthorization();
        $this->set('data', $this->Ampache->getSongs(new DataParams())->song);
        $this->viewBuilder()->setOption('serialize', 'data');
    }

    /**
     * Get song method
     *
     * @return \Cake\Http\Response|null
     */
    public function song($uid = null)
    {
        $this->Authorization->skipAuthorization();

        $song = $this->Ampache->getSong($uid);
        if ($song) {
            $this->set('data', $song);
            $this->viewBuilder()->setOption('serialize', ['data', 'message']);
        } else {
            $errorResponse = new ErrorResponse('Not found', 404);
            return $errorResponse->getResponse($this->response);
        }
    }
}

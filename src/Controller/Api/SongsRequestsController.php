<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Api\Utils\ErrorResponse;
use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\Core\Configure;


/**
 * SongsRequests Controller
 *
 * @method \App\Model\Entity\SongsResquest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SongsRequestsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Pusher', [
            'appKey' => Configure::read('Pusher.appKey'),
            'appSecret' => Configure::read('Pusher.appSecret'),
            'appId' => Configure::read('Pusher.appId'),
            'cluster' => Configure::read('Pusher.cluster')
        ]);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view', 'add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $pos_id = $this->request->getQuery('pos_id');
        if ($pos_id) {
            $songsRequests = $this->SongsRequests->find()->where(['pos_id =' => $pos_id, 'played =' => false]);
        } else {
            $songsRequests = $this->paginate($this->SongsRequests->find()->where(['played =' => false]));
        }

        $this->set(compact('songsRequests'));
        $this->viewBuilder()->setOption('serialize', 'songsRequests');
    }

    /**
     * View method
     *
     * @param string|null $id Songs Resquest id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $songRequest = $this->SongsRequests->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('songsRequest'));
        $this->viewBuilder()->setOption('serialize', 'songRequest');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $songRequest = $this->SongsRequests->newEmptyEntity();
        $songRequest = $this->SongsRequests->patchEntity($songRequest, $this->request->getData());

        $now = FrozenTime::now();
        $recent = $now->subMinutes(60);
        $previous = $this->SongsRequests->find()->where(['song_id =' => $songRequest->song_id, 'created >=' => $recent, 'pos_id =' => $songRequest->pos_id])->count();

        if ($previous > 0) {
            $errorResponse = new ErrorResponse('This song was already requested in the last hour for this POS', 429);
            return $errorResponse->getResponse($this->response);
        }

        if ($this->SongsRequests->save($songRequest)) {
            /* Notify listeners */
            $this->Pusher->publish("pos-{$songRequest->pos_id}", 'request-add', $songRequest->toArray());

            $this->set(compact('songRequest'));
            $this->viewBuilder()->setOption('serialize', 'songRequest');
        } else {
            $errorResponse = new ErrorResponse('Bad request', 400);
            return $errorResponse->getResponse($this->response);
        }
    }

    /**
     * View method
     *
     * @param string|null $id Songs Resquest id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getRequests($pos_id = null)
    {
        $songRequest = $this->SongsRequests->find()->where(['pos_id =' => $pos_id]);

        $this->set(compact('songsRequest'));
        $this->viewBuilder()->setOption('serialize', 'songRequest');
    }
}

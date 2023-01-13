<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Api\Utils\ErrorResponse;
use App\Controller\AppController;

/**
 * SongsRequests Controller
 *
 * @method \App\Model\Entity\SongsResquest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SongsRequestsController extends AppController
{
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
        if ($this->SongsRequests->save($songRequest)) {
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

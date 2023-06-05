<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Controller\Api\Utils\ErrorResponse;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;


/**
 * SongsHistory Controller
 *
 * @property \App\Model\Table\SongsHistoryTable $SongsHistory
 * @method \App\Model\Entity\SongsHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SongsHistoryController extends AppController
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
        $history = $this->paginate($this->SongsHistory);

        $this->set(compact('history'));
        $this->viewBuilder()->setOption('serialize', 'history');
    }

    /**
     * View by posId method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function view($posId)
    {
        $history = $this->SongsHistory->find()->where(['pos_id' => $posId])->order(['created' => 'DESC'])->limit(15);

        $this->set(compact('history'));
        $this->viewBuilder()->setOption('serialize', 'history');
    }

    /**
     * Add song to history method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$this->Authorization->skipAuthorization();
        $songHistory = $this->SongsHistory->newEmptyEntity();
        $data = json_decode($this->request->getBody()->getContents(), true);

        $songHistory = $this->SongsHistory->patchEntity($songHistory, $data);
        if ($this->SongsHistory->save($songHistory)) {
            /* Notify listeners */
            $this->Pusher->publish("pos-{$songHistory->pos_id}", 'history-add', $songHistory->toArray());

            /* Update requests to played */
            $SongsRequests = TableRegistry::getTableLocator()->get('SongsRequests');
            $requests = $SongsRequests->find()->where([
                'song_id =' => $songHistory->song_id,
                'pos_id =' => $songHistory->pos_id,
                'played' => false
            ]);

            foreach ($requests as $request) {
                $request->played = true;
                $SongsRequests->save($request);
            }

            $this->set(compact('songHistory'));
            $this->viewBuilder()->setOption('serialize', 'songHistory');
        } else {
            $errorResponse = new ErrorResponse('Bad request', 400);
            return $errorResponse->getResponse($this->response);
        }
    }
}

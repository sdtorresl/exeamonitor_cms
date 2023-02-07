<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

/**
 * Checks Controller
 *
 *
 * @method \App\Model\Entity\Check[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChecksController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post']);

        $check = $this->Checks->newEntity($this->request->getData());

        if ($this->Checks->save($check)) {
            $message = "saved";
            $code = 200;
        } else {
            $message = "failed";
            $code = 500;
            $this->response->withStatus(500);
        }

        $this->set([
            'code' => $code,
            'message' => $message,
            'check' => $check,
            'timestamp' => FrozenTime::now()
        ]);

        $this->viewBuilder()->setOption('serialize', ['check', 'message', 'code', 'timestamp']);
    }

    /**
     * Stats method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function stats($customer_id = null)
    {
        $this->Authorization->skipAuthorization();

        $now = FrozenTime::now();
        $recent = $now->subMinutes(60);

        $Customers = TableRegistry::getTableLocator()->get('Customers');
        $stats = $Customers->find('checks', ['recent' => $recent, 'id' => $customer_id])->first();

        $this->set(compact('stats'));
        $this->viewBuilder()->setOption('serialize', ['stats']);
    }


}

<?php
declare(strict_types=1);

namespace App\Controller;

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
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $Customers = TableRegistry::getTableLocator()->get('Customers');
        $customers = $Customers->find('all');

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($customer_id = null)
    {
        $now = FrozenTime::now();
        $recent = $now->subMinutes(60);

        $checks = $this->Checks->find('all')
            ->contain(['PointsOfSale'])
            ->where(['customer_id =' => $customer_id, 'Checks.created >=' => $recent]);

        $Customers = TableRegistry::getTableLocator()->get('Customers');
        $customer = $Customers->get($customer_id, [
            'contain' => ['PointsOfSale']
        ]);

        $this->set(compact('checks'));
        $this->set(compact('customer'));
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
        }
        else {
            $message = "failed";
            $code = 500;
            $this->response->withStatus(500);
        }
        $this->set([
            'message' => $message,
            'check' => $this->request->getData(),
            'timestamp' => FrozenTime::now()
        ]);
        
        $this->viewBuilder()->setOption('serialize', ['check', 'message', 'code', 'timestamp']);
    }

}

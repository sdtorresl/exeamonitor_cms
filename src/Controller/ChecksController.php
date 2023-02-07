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
        $this->Authorization->skipAuthorization();

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
        $this->Authorization->skipAuthorization();

        $Customers = TableRegistry::getTableLocator()->get('Customers');
        $customer = $Customers->get($customer_id, [
            'contain' => ['PointsOfSale']
        ]);

        $this->set(compact('customer'));
    }

}

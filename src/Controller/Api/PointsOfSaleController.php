<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;

class PointsOfSaleController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view']);
    }

    public function index($customerId)
    {
        $pos = $this->PointsOfSale->find()->where(['customer_id' => $customerId]);
        $this->set('data', $pos);
        $this->viewBuilder()->setOption('serialize', 'data');
    }

    public function view($id)
    {
        $pos = $this->PointsOfSale->findById($id)->contain('SongsRequests', function ($q) {
            return $q
                ->where(['SongsRequests.played' => false])
                ->order(['SongsRequests.created' => 'DESC']);
        });

        $this->set('data', $pos);
        $this->viewBuilder()->setOption('serialize', 'data');
    }
}

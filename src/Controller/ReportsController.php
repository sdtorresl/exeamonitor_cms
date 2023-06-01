<?php

namespace App\Controller;


/**
 * PointsOfSale Controller
 *
 * @property \App\Model\Table\SongsHistoryTable $songsHistoryTable
 *
 * @method \App\Model\Entity\SongsHistory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReportsController extends AppController {

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authorization->skipAuthorization();
    }

    public function dowloadReport() {
        $songsHistory = $this->songsHistoryTable->get($id, [
            'contain' => ['Countries', 'Cities', 'Customers', 'Playbooks'],
        ]);
        $this->redirect($this->referer());
    }

}

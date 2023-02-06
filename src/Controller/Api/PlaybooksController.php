<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Playbooks Controller
 *
 * @property \App\Model\Table\PlaybooksTable $Playbooks
 * @method \App\Model\Entity\Playbook[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlaybooksController extends AppController
{

    /**
     * View method
     *
     * @param string|null $id Playbook id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $playbook = $this->Playbooks->get($id, [
            'contain' => ['Customers', 'Rules'],
        ]);
        $this->Authorization->authorize($playbook);

        $this->set(compact('playbook'));
    }
}

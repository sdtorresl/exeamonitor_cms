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
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers'],
        ];
        $playbooks = $this->paginate($this->Playbooks);
        $this->Authorization->authorize($this->Playbooks);

        $this->set(compact('playbooks'));
    }

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

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $playbook = $this->Playbooks->newEmptyEntity();
        $this->Authorization->authorize($playbook);

        if ($this->request->is('post')) {
            $playbook = $this->Playbooks->patchEntity($playbook, $this->request->getData());
            if ($this->Playbooks->save($playbook)) {
                $this->Flash->success(__('The playbook has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The playbook could not be saved. Please, try again.'));
        }
        $customers = $this->Playbooks->Customers->find('list', ['limit' => 200])->all();
        $logicValues = ['random' => __('Random'), 'sorted' => __('Sorted')];
        $this->set(compact('playbook', 'customers', 'logicValues'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Playbook id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $playbook = $this->Playbooks->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($playbook);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $playbook = $this->Playbooks->patchEntity($playbook, $this->request->getData());
            if ($this->Playbooks->save($playbook)) {
                $this->Flash->success(__('The playbook has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The playbook could not be saved. Please, try again.'));
        }
        $customers = $this->Playbooks->Customers->find('list', ['limit' => 200])->all();
        $this->set(compact('playbook', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Playbook id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $playbook = $this->Playbooks->get($id);
        if ($this->Playbooks->delete($playbook)) {
            $this->Flash->success(__('The playbook has been deleted.'));
        } else {
            $this->Flash->error(__('The playbook could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

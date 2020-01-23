<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PointsOfSales Controller
 *
 * @property \App\Model\Table\PointsOfSalesTable $PointsOfSales
 *
 * @method \App\Model\Entity\PointsOfSale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PointsOfSalesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Customers'],
        ];
        $pointsOfSales = $this->paginate($this->PointsOfSales);

        $this->set(compact('pointsOfSales'));
    }

    /**
     * View method
     *
     * @param string|null $id Points Of Sale id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pointsOfSale = $this->PointsOfSales->get($id, [
            'contain' => ['Customers'],
        ]);

        $this->set('pointsOfSale', $pointsOfSale);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pointsOfSale = $this->PointsOfSales->newEntity();
        if ($this->request->is('post')) {
            $pointsOfSale = $this->PointsOfSales->patchEntity($pointsOfSale, $this->request->getData());
            if ($this->PointsOfSales->save($pointsOfSale)) {
                $this->Flash->success(__('The points of sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The points of sale could not be saved. Please, try again.'));
        }
        $customers = $this->PointsOfSales->Customers->find('list', ['limit' => 200]);
        $this->set(compact('pointsOfSale', 'customers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Points Of Sale id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pointsOfSale = $this->PointsOfSales->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pointsOfSale = $this->PointsOfSales->patchEntity($pointsOfSale, $this->request->getData());
            if ($this->PointsOfSales->save($pointsOfSale)) {
                $this->Flash->success(__('The points of sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The points of sale could not be saved. Please, try again.'));
        }
        $customers = $this->PointsOfSales->Customers->find('list', ['limit' => 200]);
        $this->set(compact('pointsOfSale', 'customers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Points Of Sale id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pointsOfSale = $this->PointsOfSales->get($id);
        if ($this->PointsOfSales->delete($pointsOfSale)) {
            $this->Flash->success(__('The points of sale has been deleted.'));
        } else {
            $this->Flash->error(__('The points of sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

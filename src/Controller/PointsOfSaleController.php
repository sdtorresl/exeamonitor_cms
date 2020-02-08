<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * PointsOfSale Controller
 *
 * @property \App\Model\Table\PointsOfSaleTable $PointsOfSale
 *
 * @method \App\Model\Entity\PointsOfSale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PointsOfSaleController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Countries', 'Cities', 'Customers'],
        ];
        $pointsOfSale = $this->paginate($this->PointsOfSale);

        $this->set(compact('pointsOfSale'));
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
        $pointsOfSale = $this->PointsOfSale->get($id, [
            'contain' => ['Countries', 'Cities', 'Customers'],
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
        $pointsOfSale = $this->PointsOfSale->newEmptyEntity();
        $countriesTable = TableRegistry::getTableLocator()->get('Countries');

        if ($this->request->is('post')) {

            $postData = $this->request->getData();

            $pointsOfSale = $this->PointsOfSale->patchEntity($pointsOfSale, $postData);

            $country_id = $countriesTable->findByCode($postData['country_id'])->first()['id'];
            $pointsOfSale->country_id = $country_id;

            if ($this->PointsOfSale->save($pointsOfSale)) {
                $this->Flash->success(__('The points of sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The points of sale could not be saved. Please, try again.'));
        }

        
        $countries = array();
        $query = $countriesTable->find();
        foreach ($query as $id => $country) {
            $countries[$country->code] = $country->name;
        }

        $cities = $this->PointsOfSale->Cities->find('list', ['limit' => 10]);
        $customers = $this->PointsOfSale->Customers->find('list', ['limit' => 200]);
        $this->set(compact('pointsOfSale', 'countries', 'cities', 'customers', 'countryChoices'));
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
        $pointsOfSale = $this->PointsOfSale->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pointsOfSale = $this->PointsOfSale->patchEntity($pointsOfSale, $this->request->getData());
            if ($this->PointsOfSale->save($pointsOfSale)) {
                $this->Flash->success(__('The points of sale has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The points of sale could not be saved. Please, try again.'));
        }
        $countries = $this->PointsOfSale->Countries->find('list', ['limit' => 200]);
        $cities = $this->PointsOfSale->Cities->find('list', ['limit' => 200]);
        $customers = $this->PointsOfSale->Customers->find('list', ['limit' => 200]);
        $this->set(compact('pointsOfSale', 'countries', 'cities', 'customers'));
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
        $pointsOfSale = $this->PointsOfSale->get($id);
        if ($this->PointsOfSale->delete($pointsOfSale)) {
            $this->Flash->success(__('The points of sale has been deleted.'));
        } else {
            $this->Flash->error(__('The points of sale could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}

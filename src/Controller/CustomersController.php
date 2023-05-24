<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $customers = $this->paginate($this->Customers);
        $this->Authorization->authorize($this->Customers);

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['PointsOfSale', 'PointsOfSale.Countries', 'PointsOfSale.Cities'],
        ]);
        $this->Authorization->authorize($customer);

        $this->set('customer', $customer);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        $this->Authorization->authorize($customer);
        $currentUser = $this->request->getAttribute('identity');
        $count = $this->Customers->find()
            ->where(['created_by' => $currentUser->id])
            ->count();
        if ($currentUser->amount_customers && $count >= $currentUser->amount_customers) {
            $this->Flash->error(__('Creation limit exceeded for current user.'));
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['created_by'] = $currentUser->id;
            $customer = $this->Customers->patchEntity($customer, $data);
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($customer);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $this->set(compact('customer'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        $this->Authorization->authorize($customer);

        try {
            $this->Customers->delete($customer);
            $this->Flash->success(__('The customer has been deleted.'));
        } catch (\PDOException $e) {
            $this->Flash->error(__('The customer could not be deleted because it has associated data.'));
        } catch (\Exception $e) {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function player($id = null)
    {
        $preview = ((bool) $this->request->getQuery('preview')) ?? false;

        $customer = $this->Customers->get($id, [
            'contain' => ['PointsOfSale.Countries', 'PointsOfSale.Cities'],
        ]);
        $this->Authorization->authorize($customer);

        $this->set('customer', $customer);
        $this->set('preview', $preview);

        if($preview === false) {
            $this->viewBuilder()->setLayout('player');
        }
    }


    /**
     * Metadata method
     *
     * @param string $stream Stream URL
     * @return \Cake\Http\Response
     */
    public function metadata() {
        $stream_url = $this->request->getQuery('stream');
        $header = $this->getMp3StreamTitle($stream_url, 19200);
        $data = explode(" - ", $header);

        $metadata = [
            'artist' => $data[0],
            'title' => $data[1]
        ];

        $this->set(compact('metadata'));
        $this->viewBuilder()->setOption('serialize', ['metadata']);
    }

    private function getMp3StreamTitle($streamingUrl, $interval = 19200, $offset = 0, $headers = true) {
        $needle = 'StreamTitle=';
        $ua = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36';

        $opts = array('http' => array(
            'method' => 'GET',
            'header' => 'Icy-MetaData: 1',
            'user_agent' => $ua
        ));

        if (($headers = get_headers($streamingUrl)))
            foreach($headers as $h) {
                $currentSection = explode(':', $h);
                if (strpos(strtolower($h), 'icy-metaint') !== false && ($interval = $currentSection[1]))
                    break;
            }

        $context = stream_context_create($opts);

        if ($stream = fopen($streamingUrl, 'r', false, $context)) {
            $buffer = stream_get_contents($stream, $interval, $offset);
            fclose($stream);

            if (strpos($buffer, $needle) !== false) {
                $currentSectionTwo = explode($needle, $buffer);
                $title = $currentSectionTwo[1];
                return substr($title, 1, strpos($title, ';') - 2);
            } else
                return $this->getMp3StreamTitle($streamingUrl, $interval, $offset + $interval, false);
        } else
            throw new \Exception("Unable to open stream [{$streamingUrl}]");
    }
}

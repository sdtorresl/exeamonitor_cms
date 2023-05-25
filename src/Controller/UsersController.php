<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Utility\Text;
use Cake\Mailer\MailerAwareTrait;



/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    use MailerAwareTrait;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'edit', 'forgotPassword', 'resetPassword']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->Authorization->authorize($this->Users);
        $this->paginate = [
            'contain' => ['PointsOfSale'],
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['PointsOfSale', 'PasswordsResets'],
        ]);
        $this->Authorization->authorize($user);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        $this->Authorization->authorize($user);

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            try {
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            } catch (\PDOException $error) {
                if ($error->errorInfo[0] = '23000') {
                    $this->Flash->error(__('A user is already assigned to this point of sale'));
                } else {
                    $this->Flash->error($error->errorInfo[2]);
                }
                $this->set('error', $error);
            }
        }
        $pointOfSales = $this->Users->PointsOfSale->find('list', ['limit' => 200]);
        $this->set(compact('user', 'pointOfSales'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($user);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            try {
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            } catch (\PDOException $error) {
                if ($error->errorInfo[0] = '23000') {
                    $this->Flash->error(__('A user is already assigned to this point of sale'));
                } else {
                    $this->Flash->error($error->errorInfo[2]);
                }
                $this->set('error', $error);
            }
        }
        $pointOfSales = $this->Users->PointsOfSale->find('list', ['limit' => 200]);
        $this->set(compact('user', 'pointOfSales'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Authorization->authorize($user);

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null Redirects on successful login, renders view otherwise.
     */
    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity()->getOriginalData();

            if ($user->enabled) {
                $user->last_access = FrozenTime::now();
                $this->Users->save($user);

                return $this->redirect($this->getRedirect($user));
            } else {
                $this->Flash->error(__('User is not enabled'));
            }
        }

        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }

        $this->viewBuilder()->setLayout('login');
    }

    /**
     * Logout method
     *
     * @return \Cake\Http\Response|null Redirects on successful logout
     */
    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['_name' => 'login']);
        }
    }

    /**
     * Forgot Password method
     *
     * @return \Cake\Http\Response|null Render view and redirect on successful password change
     */
    public function forgotPassword()
    {
        $this->Authorization->skipAuthorization();

        if ($this->request->is('post')) {
            $email = $this->request->getData('email');

            $users = $this->Users;
            $user = $users->findByEmail($email)->first();

            if ($user) {

                // Setting token to the user
                $user->token = Text::uuid();
                $user->token_expiry_date = FrozenTime::now()->addHours(2);
                $user->token_used = false;
                $users->save($user);

                // Mail to user
                $this->getMailer("User")->send('resetPassword', [$user]);

                $this->Flash->success('Por favor revisa tu correo electrónico para restablecer tu contraseña.');
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error('Correo electrónico invalido');
            }
        }

        $this->viewBuilder()->setLayout('login');
    }

    public function resetPassword($token = null)
    {
        $this->Authorization->skipAuthorization();

        if (!empty($token)) {

            $users = $this->Users;
            $user = $users->findByToken($token)->first();

            if ($user) {
                if ($this->request->is('post')) {
                    if (!$user->token_used && FrozenTime::now() < $user->token_expiry_date) {

                        $newPassword = $this->request->getData('password');

                        if ($newPassword == $this->request->getData('passwordConfirmation')) {

                            // Setting token and new password
                            $user->token_used = true;
                            $user->password = $newPassword;

                            if ($users->save($user)) {
                                $this->Flash->success('Tu nueva contraseña ha sido actualizada satisfactoriamente.');
                                return $this->redirect(['action' => 'login']);
                            } else {
                                $this->Flash->error('Tu contraseña no se pudo guardar. Inténtalo de nuevo.');
                            }
                        } else {
                            $this->Flash->error('Las contraseñas no coinciden. Verifica de nuevo.');
                        }
                    } else {
                        $this->Flash->error('El token ha expirado o ya ha sido utilizado.');
                        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
                    }
                }
            } else {
                $this->Flash->error('El token no es válido.');
                return $this->redirect(['controller' => 'Users', 'action' => 'login']);
            }
        }

        $this->viewBuilder()->setLayout('login');
    }

    private function getRedirect($user)
    {
        if ($user->role === 'admin' || $user->role === 'customers_manager') {
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Checks',
                'action' => 'index',
            ]);
        } else {
            $PointsOfSale = $this->fetchTable('PointsOfSale');
            $pos = $PointsOfSale->get($user->point_of_sale_id);
            $customerId = $pos->customer_id;

            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Customers',
                'action' => 'player',
                $customerId
            ]);
        }

        return $redirect;
    }
}

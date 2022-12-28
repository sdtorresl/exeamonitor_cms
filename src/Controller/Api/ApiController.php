<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Utility\Text;
use Cake\Mailer\MailerAwareTrait;



/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApiController extends AppController
{
    use MailerAwareTrait;


    /**
     * Login method
     *
     * @return \Cake\Http\Response|null Redirects on successful login, renders view otherwise.
     */
    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['post']);
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity()->getOriginalData();

            if ($user->enabled) {
                // $user->last_access = Time::now();
                // $this->Users->save($user);
                $data = $user;
            } else {
                $this->response = $this->response->withStatus(401);
                $data = ['error' => 'user_not_enabled', 'msg' => __('User is not enabled')];
            }
        } else {
            $this->response = $this->response->withStatus(401);
            $data = ['error' => 'invalid_password', 'msg' => __('Invalid username or password')];
        }

        $this->set('response', $data);
        $this->viewBuilder()->setOption('serialize', 'response');
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
                $user->token_expiry_date = Time::now()->addHours(2);
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
                    if (!$user->token_used && Time::now() < $user->token_expiry_date) {

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
        if ($user->role == 'admin') {
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Checks',
                'action' => 'index',
            ]);
        } else {
            $this->loadModel('PointsOfSale');
            $pos =  $this->PointsOfSale->get($user->point_of_sale_id);
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

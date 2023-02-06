<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Mailer\MailerAwareTrait;
use Cake\Utility\Text;
use Firebase\JWT\JWT;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;


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

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

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
                $Users = TableRegistry::getTableLocator()->get('Users');

                $user->last_access = FrozenTime::now();
                $Users->save($user);

                $key = Security::getSalt();
                $payload = [
                    'sub' => $user->id,
                    'exp' => time() + 60,
                ];

                $jwtToken = JWT::encode($payload, $key, 'HS256');
                $data = [
                    'token' => $jwtToken,
                    'user' => $user,
                ];
            } else {
                $this->response = $this->response->withStatus(401);
                $data = ['error' => 'user_not_enabled', 'msg' => __('User is not enabled')];
            }
        } else {
            $this->response = $this->response->withStatus(401);
            $data = ['error' => 'invalid_credentials', 'msg' => __('Invalid username or password')];
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
        }
    }

    public function renewToken()
    {
        $this->request->allowMethod(['get']);
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $user = $this->Authentication->getIdentity()->getOriginalData();

            $key = Security::getSalt();
            $payload = [
                'sub' => $user->id,
                'exp' => time() + 3600,
            ];

            $jwtToken = JWT::encode($payload, $key, 'HS256');
            $data = [
                'token' => $jwtToken,
                'user' => $user,
            ];
        } else {
            $this->response = $this->response->withStatus(401);
            $data = ['error' => 'invalid_token', 'msg' => __('Invalid token')];
        }

        $this->set('response', $data);
        $this->viewBuilder()->setOption('serialize', 'response');
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Checks Controller
 *
 *
 * @method \App\Model\Entity\Check[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChecksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $checks = $this->paginate($this->Checks);

        $this->set(compact('checks'));
    }
}

<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add', 'logout');
    }

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['login', 'logout']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if (in_array($action, ['index', 'view', 'edit', 'delete', 'indexAdmin', 'aprovar', 'classificacao', 'editAmin', 'viewAdmin', 'listarIncristos', 'protocoloEntrega'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Grupos'],
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
            'contain' => ['Grupos'],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->active = 1;
            $user->sistema = 1;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('O usuário foi cadastrado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Houve um erro, o usuário não foi cadastrado.'));
        }
        $grupos = $this->Users->Grupos->find('list');
        $this->set(compact('user', 'grupos'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $userName = $this->request->getSession()->read('Auth.User');
            // debug($user);
            // die;
            if ($userName['sistema'] == 1) {
                // debug($user);
                // die;
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('A alteração foi cadastrada'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Houve um erro, o cadastro não foi alterado'));
            } else {
                $this->Flash->error('Você não está autorizado a essa alteração.');
                $this->redirect(['controller' => 'candidatos', 'action' => 'indexAdmin']);
            }
        }
        $grupos = $this->Users->Grupos->find('list');
        $this->set(compact('user', 'grupos'));
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
        // $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $logado = $this->request->getSession()->read('Auth.User')['sistema'];
        if ($logado == 1) {
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('O usuário foi excluído.'));
            } else {
                $this->Flash->error(__('Houve um erro, não foi excluído o usuário.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {


        if ($this->request->is('post')) {
            // $user = $this->request->getData();
            // $user = $this->Users->newEntity();
            $user = $this->Auth->identify();

            // debug($user);
            // die;

            if ($user['active'] == 1) {
                $this->Auth->setUser($user);
                return $this->redirect(['controller' => 'candidatos', 'action' => 'indexAdmin']);
            } else {
                return $this->redirect(['controller' => 'pages', 'action' => 'home']);
                $this->Flash->error('Você está Desativado.');
            }
            // $this->Flash->error('Usuário ou senha invalido, tente novamente');
        }

        // $this->set('user', $user);
    }

    public function logout()
    {
        $this->Flash->success('Você está desconectado.');
        return $this->redirect($this->Auth->logout());
    }
}

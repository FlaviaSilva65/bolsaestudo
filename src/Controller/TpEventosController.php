<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TpEventos Controller
 *
 * @property \App\Model\Table\TpEventosTable $TpEventos
 *
 * @method \App\Model\Entity\TpEvento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */


class TpEventosController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if (in_array($action, ['index', 'add', 'edit'])) {
            return true;
        }
    }
    public function index()
    {
        $tp_eventos = $this->TpEventos->find();

        $this->set(compact('tp_eventos'));
    }
    public function add()
    {
        $tp_evento = $this->TpEventos->newEntity();
        if ($this->request->is('post')) {
            $tp_evento = $this->TpEventos->patchEntity($tp_evento, $this->request->getData());
            if ($this->TpEventos->save($tp_evento)) {
                $this->Flash->success('Tipo do Evento cadadastrado.');
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Tipo de evento nÃ£o pode ser gravado.');
            }
        }

        $this->set(compact('tp_evento'));
    }

    public function edit($id = null)
    {
        $tp_evento = $this->TpEventos->get($id, []);

        if ($this->request->is(['post', 'put'])) {
            $tp_evento = $this->TpEventos->patchEntity($tp_evento, $this->request->getData());

            if ($this->TpEventos->save($tp_evento)) {
                $this->Flash->success('Tipo do Evento alterado');
                $this->redirect(['action' => 'index']);
            } else {
                $this->TpEventos->error('Tipo do Evento não foi alterado');
            }
        }

        $this->set(compact('tp_evento'));
    }
}

<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventos Controller
 *
 * @property \App\Model\Table\EventosTable $Eventos
 *
 * @method \App\Model\Entity\Candidato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */


class EventosController extends AppController
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
        $eventos = $this->paginate($this->Eventos->find()
            ->contain([
                'TpEventos'
            ]), ['limit' => 20]);

        $this->set(compact('eventos'));
    }
    public function add()
    {
        $this->loadModel('TpEventos');
        $evento = $this->Eventos->newEntity();
        if ($this->request->is('post')) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->getData());
            $data_inicio = $this->request->getData(['dt_inicio']);
            $data = explode('-', $data_inicio);
            $ano = $data[0];
            $evento->ano_evento = $ano;
            $evento->ic_ativo = 1;
            if ($this->Eventos->save($evento)) {
                $this->Flash->success('Evento cadastrado.');
                $this->redirect(['action' => 'index']);
            }
        }

        $tp_eventos = $this->Eventos->TpEventos->find('list');
        $this->set(compact('evento', 'tp_eventos'));
    }
    public function edit($id = null)
    {
        $this->loadModel('TpEventos');
        $evento = $this->Eventos->get($id, [
            'contain' => ['TpEventos']
        ]);

        if ($this->request->is(['post', 'put'])) {

            $evento = $this->Eventos->patchEntity($evento, $this->request->getData());
            $data_inicio = $this->request->getData(['dt_inicio']);
            $data = explode('-', $data_inicio);
            $ano = $data[0];

            $evento->ano_evento = $ano;
            if ($this->Eventos->save($evento)) {
                $this->Flash->success('Inscrição alterada.');
                $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Inscrição não pode ser alterada');
            }
        }

        $tp_eventos = $this->Eventos->TpEventos->find('list');
        $this->set(compact('evento', 'tp_eventos'));
    }
}

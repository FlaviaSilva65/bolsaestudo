<?php
/* SEDUC DPID - Flavia Silva 47093 em 12/04/2022*/

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use DateTime;
use Cake\Datasource\ConnectionManager;

/**
 * Responsavels Controller
 *
 * @property \App\Model\Table\ResponsavelsTable $Responsavels
 *
 * @method \App\Model\Entity\Responsavel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResponsavelsController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['add', 'search']);
    }

    public function add()
    {
        $this->loadModel('Eventos');

        $responsavel = $this->Responsavels->newEntity();

        $ano = date('Y');
        $hoje = date('Y-m-d');

        $evento = $this->Eventos->find()
            ->where(['tp_eventos_id' => 1])
            ->last();

        if ($hoje >= $evento->dt_inicio) {
            $inscrInicio = true;
        } else {
            $inscrInicio = false;
        }
        if ($hoje <= date_format($evento->dt_fim, "Y-m-d")) {
            $inscrFim = true;
        } else {
            $inscrFim = false;
        }

        if ($inscrInicio == true && $inscrFim == true) {
            $inscricao = true;
        }

        if ($this->request->is('post')) {
            $id = $this->request->getData('id');
            // if (isset($this->request->getData('id'))) {
            if ($id !== null) {
                $responsavel = $this->Responsavels->get($this->request->getData('id'));
            } else {
                $responsavel = $this->Responsavels->patchEntity($responsavel, $this->request->getData());
            }
            debug($responsavel);
            debug($this->request->getData());
            die;
        }

        $this->set('responsavel', $responsavel);
    }

    public function search()
    {
        $this->viewBuilder()->setLayout(false);
        $pesquisa = true;
        $keyword = $this->request->getQuery('keyword');
        // echo "Cheguei aqui no Controller";
        // die;
        if ($keyword != '') :
            $query = $this->Responsavels->find()
                ->where([

                    'vl_cpf' => $keyword,
                ])->first();

            // debug($query);
            // die;
            $escolas = $this->Responsavels->Escolas->find('list', ['limit' => 200])->where(['ic_ativo' => 1]);
            $this->set([
                'responsavels' => $query,
                'keyword' => $keyword,
                'pesquisa' => $pesquisa,
                'escolas' => $escolas
            ]);
        endif;
    }
}

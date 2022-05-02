<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Escolas Controller
 *
 * @property \App\Model\Table\EscolasTable $Escolas
 *
 * @method \App\Model\Entity\Candidato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */


class EscolasController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if (in_array($action, ['index', 'add', 'view', 'edit', 'inativar', 'delete'])) {
            return true;
        }
    }

    public function index()
    {

        $escolas =  $this->paginate($this->Escolas->find()->contain([
            'EscolasTipos' => ['Tipos']
        ]), [
            'limit' => 30,
            'order' => ['nm_escola' => 'ASC']
        ]);


        $this->set('escolas', $escolas);
    }

    public function add()
    {
        $this->loadModel('EscolasTipos');
        $this->loadModel('EscolasTiposAnos');
        $this->loadModel('Anos');
        $escola = $this->Escolas->newEntity();


        if ($this->request->is('post')) {
            $escola = $this->Escolas->patchEntity($escola, $this->request->getData());
            // $escola_tipo = $this->EscolasTipos->patchEntity($escola_tipo, $this->request->getData());


            $escola->ic_ativo = 1;

            if ($this->Escolas->save($escola)) {

                if ($this->request->getData('tipo_id_1') != 0) {
                    $escola_tipo = $this->EscolasTipos->newEntity();
                    $escola_tipo->escola_id = $escola->id;
                    $escola_tipo->tipo_id = $this->request->getData('tipo_id_1');
                    $this->EscolasTipos->save($escola_tipo);

                    if ($this->request->getData('ano_id_ei1') != 0) {
                        $escola_ano = $this->EscolasTiposAnos->newEntity();
                        $escola_ano->escolas_tipo_id = $escola_tipo->id;
                        $escola_ano->ano_id = $this->request->getData('ano_id_ei1');
                        $this->EscolasTiposAnos->save($escola_ano);
                    }
                    if ($this->request->getData('ano_id_ei14') != 0) {
                        $escola_ano = $this->EscolasTiposAnos->newEntity();
                        $escola_ano->escolas_tipo_id = $escola_tipo->id;
                        $escola_ano->ano_id = $this->request->getData('ano_id_ei14');
                        $this->EscolasTiposAnos->save($escola_ano);
                    }
                }
                if ($this->request->getData('tipo_id_2') != 0) {
                    $escola_tipo = $this->EscolasTipos->newEntity();
                    $escola_tipo->escola_id = $escola->id;
                    $escola_tipo->tipo_id = $this->request->getData('tipo_id_2');
                    $this->EscolasTipos->save($escola_tipo);
                    for ($i = 2; $i <= 10; $i++) {
                        if ($this->request->getData('ano_id_ef' . $i) != 0) {
                            $escola_ano = $this->EscolasTiposAnos->newEntity();
                            $escola_ano->escolas_tipo_id = $escola_tipo->id;
                            $escola_ano->ano_id = $this->request->getData('ano_id_ef' . $i);
                            $this->EscolasTiposAnos->save($escola_ano);
                        }
                    }
                }
                if ($this->request->getData('tipo_id_3') != 0) {
                    $escola_tipo = $this->EscolasTipos->newEntity();
                    $escola_tipo->escola_id = $escola->id;
                    $escola_tipo->tipo_id = $this->request->getData('tipo_id_3');
                    $this->EscolasTipos->save($escola_tipo);
                    for ($i = 11; $i <= 13; $i++) {
                        if ($this->request->getData('ano_id_em' . $i) != 0) {
                            $escola_ano = $this->EscolasTiposAnos->newEntity();
                            $escola_ano->escolas_tipo_id = $escola_tipo->id;
                            $escola_ano->ano_id = $this->request->getData('ano_id_em' . $i);
                            $this->EscolasTiposAnos->save($escola_ano);
                        }
                    }
                }
                $this->Flash->success('Escola cadastrada com sucesso.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Escola não foi cadastrada.');
            }
        }

        $ei_tipos = $this->Anos->find('all')->where(['tipo_id' => 1]);
        $ef_tipos = $this->Anos->find('all')->where(['tipo_id' => 2]);
        $em_tipos = $this->Anos->find('all')->where(['tipo_id' => 3]);

        $this->set(compact('escola', 'escola_tipo', 'ei_tipos', 'ef_tipos', 'em_tipos'));
    }

    public function opcoesAnos1()
    {

        $this->loadModel('Anos');
        $eianos = $this->Anos->find('all')
            ->where(['tipo_id' => 1]);

        $this->set(compact('eianos'));
    }

    public function edit($id = null)
    {
        $this->loadModel('EscolasTipos');
        $this->loadModel('EscolasTiposAnos');
        $this->loadModel('Anos');
        $this->loadModel('Tipos');

        $escola = $this->Escolas->get($id, [
            'contain' => ['EscolasTipos'],
        ]);

        if ($escola->ic_ativo == 0) {
            $ativo = false;
            $this->set(compact('ativo'));
        } else {
            $ativo = true;
            $this->set(compact('ativo'));
        }

        // $escola_tipos = $this->Escolas->EscolasTipos->find('all', [
        //     'conditions' => ['escola_id' => $escola->id, 'ic_ativo' => 1]
        // ]);
        $escola_tipos = $this->Escolas->EscolasTipos->find('all', [
            'conditions' => ['escola_id' => $escola->id]
        ]);


        foreach ($escola_tipos as $escola_tipo) :

            if ($escola_tipo->tipo_id == 1) {
                $ei =  $escola_tipo->tipo_id;
                $ei_id = $escola_tipo->id;
                $ei_tipos = $this->EscolasTiposAnos->find('all', [
                    'conditions' => ['escolas_tipo_id' => $escola_tipo->id],
                    'contain' => ['Anos']
                ]);

                $ei_count = $this->EscolasTiposAnos->find()
                    ->where(['escolas_tipo_id' => $escola_tipo->id])
                    ->count();

                $ei_ativo = $escola_tipo->ic_ativo;
                $this->set(compact('ei', 'ei_tipos', 'ei_ativo'));
            } else if ($escola_tipo->tipo_id == 2) {
                $ef = $escola_tipo->tipo_id;
                $ef_id = $escola_tipo->id;
                $ef_tipos = $this->EscolasTiposAnos->find('all', [
                    'conditions' => ['escolas_tipo_id' => $escola_tipo->id],
                    'contain' => ['Anos']
                ]);

                $ef_count = $this->EscolasTiposAnos->find()
                    ->where(['escolas_tipo_id' => $escola_tipo->id])
                    ->count();

                $ef_ativo = $escola_tipo->ic_ativo;
                $this->set(compact('ef', 'ef_tipos', 'ef_ativo'));
            } else if ($escola_tipo->tipo_id == 3) {
                $em = $escola_tipo->tipo_id;
                $em_id = $escola_tipo->id;
                $em_tipos = $this->EscolasTiposAnos->find('all', [
                    'conditions' => ['escolas_tipo_id' => $escola_tipo->id],
                    'contain' => ['Anos']
                ]);

                $em_count = $this->EscolasTiposAnos->find()
                    ->where(['escolas_tipo_id' => $escola_tipo->id])
                    ->count();

                $em_ativo = $escola_tipo->ic_ativo;
                $this->set(compact('em', 'em_tipos', 'em_ativo'));
            }
        endforeach;
        if (isset($ei) == false) {
            $ei = 0;
            $ei_tipos = $this->Anos->find('all')->where(['tipo_id' => 1]);
            $ei_count = $this->Anos->find()->where(['tipo_id' => 1])->count();
            $this->set(compact('ei', 'ei_tipos', 'ei_count'));
        }
        if (isset($ef) == false) {
            $ef = 0;
            $ef_tipos = $this->Anos->find('all')->where(['tipo_id' => 2]);
            $ef_count = $this->Anos->find()->where(['tipo_id' => 2])->count();
            $this->set(compact('ef', 'ef_tipos', 'ef_count'));
        }
        if (isset($em) == false) {
            $em = 0;
            $em_tipos = $this->Anos->find('all')->where(['tipo_id' => 3]);
            $em_count = $this->Anos->find()->where(['tipo_id' => 3])->count();
            $this->set(compact('em', 'em_tipos', 'em_count'));
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            $escola = $this->Escolas->patchEntity($escola, $this->request->getData());

            // A variável $ef_count é usada para armazenar a quantidade de anos para cada nível

            if ($ei == 1) {
                $escola_tp = $this->EscolasTipos->get($ei_id);
                // debug($this->request->getData());
                // die;
                if ($this->request->getData('tipo_id_1') == 0) {
                    // $escola_tp = $this->EscolasTipos->patchEntity($escola_tp);
                    $escola_tp->ic_ativo = 0;
                    $this->EscolasTipos->save($escola_tp);
                    $this->redirect(['action' => 'view', $escola->id]);
                } else {
                    $escola_tp->ic_ativo = 1;
                    $this->EscolasTipos->save($escola_tp);
                    for ($i = 1; $i <= $ei_count; $i++) {
                        $array = $this->request->getData('id_ei,' . $i);
                        $valor = $this->request->getData('ano_id_ei,' . $i);
                        if ($valor == 0) {

                            $escola_tp_ano = $this->EscolasTiposAnos->get($array);
                            $escola_tp_ano->ic_ativo = 0;

                            // debug($escola_tp_ano);
                            // die;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                            // $this->redirect(['action'=>'view', $escola->id]);
                        } else {
                            $escola_tp_ano = $this->EscolasTiposAnos->get($array);
                            $escola_tp_ano->ic_ativo = 1;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                        }
                    }
                }
            }
            if ($ef == 2) {
                $escola_tp = $this->EscolasTipos->get($ef_id);
                if ($this->request->getData('tipo_id_2') == 0) {
                    $escola_tp->ic_ativo = 0;
                    $this->EscolasTipos->save($escola_tp);
                    $this->redirect(['action' => 'view', $escola->id]);
                    // $this->redirect($this->referer());
                } else {
                    $escola_tp->ic_ativo = 1;
                    $this->EscolasTipos->save($escola_tp);
                    for ($i = 1; $i <= $ef_count; $i++) {
                        // debug($this->request->getData());
                        // die;
                        $array = $this->request->getData('id_ef,' . $i);
                        $valor = $this->request->getData('ano_id_ef,' . $i);
                        // debug($array);
                        // debug($valor);
                        // die;
                        if ($valor == 0) {
                            $escola_tp_ano = $this->EscolasTiposAnos->get($array);
                            $escola_tp_ano->ic_ativo = 0;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                            // $this->redirect(['action'=>'view', $escola->id]);
                        } else {
                            $escola_tp_ano = $this->EscolasTiposAnos->get($array);
                            $escola_tp_ano->ic_ativo = 1;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                        }
                    }
                }
            }
            if ($em == 3) {
                $escola_tp = $this->EscolasTipos->get($em_id);
                // debug($escola_tp);
                if ($this->request->getData('tipo_id_3') == 0) {
                    $escola_tp->ic_ativo = 0;
                    $this->EscolasTipos->save($escola_tp);
                    $this->redirect(['action' => 'view', $escola->id]);
                } else {
                    $escola_tp->ic_ativo = 1;
                    $this->EscolasTipos->save($escola_tp);
                    // debug($this->request->getData());
                    for ($i = 1; $i <= $em_count; $i++) {
                        $array = $this->request->getData('id_em,' . $i);
                        $valor = $this->request->getData('ano_id_em,' . $i);
                        if ($valor == 0) {
                            // debug($array);
                            $escola_tp_ano = $this->EscolasTiposAnos->get($array);
                            $escola_tp_ano->ic_ativo = 0;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                            // $this->redirect(['action'=>'view', $escola->id]);
                        } else {
                            // debug($array);
                            $escola_tp_ano = $this->EscolasTiposAnos->get($array);
                            $escola_tp_ano->ic_ativo = 1;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                            // die();
                        }
                    }
                }
            }
            if ($ei == 0) {
                if ($this->request->getData('tipo_id_1') == 1) {
                    $escola_tp = $this->EscolasTipos->newEntity();
                    $escola_tp->escola_id = $escola->id;
                    $escola_tp->tipo_id = 1;
                    $escola_tp->ic_ativo = 1;
                    $this->EscolasTipos->save($escola_tp);
                    // $this->redirect(['action'=>'view', $escola->id]);
                    $i = 1;
                    while ($i <= $ei_count) {
                        $array = $this->request->getData('ano_id_ei,' . $i);
                        if ($array !== 0) {
                            $escola_tp_ano = $this->EscolasTiposAnos->newEntity();
                            $escola_tp_ano->escolas_tipo_id = $escola_tp->id;
                            $escola_tp_ano->ano_id = $array;
                            $escola_tp_ano->ic_ativo = 1;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                        }
                        $i++;
                    }
                }
            }

            if ($ef == 0) {
                if ($this->request->getData('tipo_id_2') == 1) {
                    $escola_tp = $this->EscolasTipos->newEntity();
                    $escola_tp->escola_id = $escola->id;
                    $escola_tp->tipo_id = 2;
                    $escola_tp->ic_ativo = 1;
                    $this->EscolasTipos->save($escola_tp);
                    for ($i = 1; $i <= $ef_count; $i++) {
                        $array = $this->request->getData('ano_id_ef,' . $i);

                        if ($array != 0) {
                            $escola_tp_ano = $this->EscolasTiposAnos->newEntity();
                            $escola_tp_ano->escolas_tipo_id = $escola_tp->id;
                            $escola_tp_ano->ano_id = $array;
                            $escola_tp_ano->ic_ativo = 1;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                        }
                    }
                }
            }
            if ($em == 0) {
                if ($this->request->getData('tipo_id_3') == 1) {
                    $escola_tp = $this->EscolasTipos->newEntity();
                    $escola_tp->escola_id = $escola->id;
                    $escola_tp->tipo_id = 3;
                    $escola_tp->ic_ativo = 1;
                    $this->EscolasTipos->save($escola_tp);
                    for ($i = 1; $i <= $em_count; $i++) {
                        $array = $this->request->getData('ano_id_em,' . $i);

                        if ($array != 0) {
                            $escola_tp_ano = $this->EscolasTiposAnos->newEntity();
                            $escola_tp_ano->escolas_tipo_id = $escola_tp->id;
                            $escola_tp_ano->ano_id = $array;
                            $escola_tp_ano->ic_ativo = 1;
                            $this->EscolasTiposAnos->save($escola_tp_ano);
                        }
                    }
                }
            }

            if ($ativo == false) {
                $escola->ic_ativo = 1;
            }
            if ($this->Escolas->save($escola)) {
                $this->Flash->success('As informações foram alteradas.');

                return $this->redirect(['action' => 'view', $escola->id]);
            } else {
                $this->Flash->error('As informações não foram alteradas.Tente novamente');
            }
        }

        $this->set(compact('escola', 'escola_tipos'));
    }

    public function inativar($id = null)
    {
        // $this->request->allowMethod(['post', 'inativar']);
        $escola = $this->Escolas->get($id);
        $escola->ic_ativo = 0;
        // debug($escola);
        // die;
        if ($this->Escolas->save($escola)) {
            $this->Flash->success('A escola está Inativa');
            $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('A escola não foi Inativada. Verifique o erro');
        };
    }

    public function view($id = null)
    {
        $this->loadModel('EscolasTiposAnos');

        $this->loadModel('Tipos');
        $this->loadModel('Anos');

        $escola = $this->Escolas->get($id, [
            'contain' => ['EscolasTipos' => ['Tipos', 'EscolasTiposAnos' => ['Anos']]]

            // 'type' => 'RIGHT'
        ]);
        // $escola = $this->Escolas->get($id);

        $escola_tipos = $this->Escolas->EscolasTipos->find()
            ->where(['EscolasTipos.escola_id' => $escola->id])
            ->contain(['Tipos', 'EscolasTiposAnos' => ['Anos']])
            ->order(['Tipos.id' => 'ASC'])
            ->all();

        // debug($escola_tipo);
        // die();
        // $escola->join([
        //     'table' => 'tipos',
        //     'alias' => 'Tipos',
        //     'type' => 'LEFT',
        //     'conditions' => 'Tipos.id = Escolas.EscolasTipos.tipo_id'
        // ]);
        // $escola->join([
        //     'table' => 'tipos',
        //     'alias' => 'Tipos',
        //     'type' => 'LEFT',
        //     'conditions' => 'Tipos.id = Escolas.EscolasTipos.tipo_id'

        // ]);

        $this->set(compact('escola', 'escola_tipos'));
    }
    public function delete($id = null)
    {
        $user = $this->Auth->user();
        if ($this->Auth->user()) {
            // $this->request->allowMethod(['post', 'delete']);
        }

        $escola = $this->Escolas->get($id);
        if ($this->Escolas->delete($escola)) {
            $this->Flash->success('Escola excluída.');
        } else {
            $this->Flash->error('Não foi possível excluir');
        }
        return $this->redirect(['action' => 'index']);
    }
}

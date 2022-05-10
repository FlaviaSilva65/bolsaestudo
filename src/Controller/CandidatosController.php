<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use DateTime;
use Cake\Datasource\ConnectionManager;

// use Cake\Controller\Component;


/**
 * Candidatos Controller
 *
 * @property \App\Model\Table\CandidatosTable $Candidatos
 *
 * @method \App\Model\Entity\Candidato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CandidatosController extends AppController
{ //$impressaoRec = false;
    // public function initialize()
    // {
    //     $this->Auth->allow(['add', 'index_admin']);
    // }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['add', 'addCand', 'imprimir', 'login', 'index', 'view', 'opcoesTipos', 'opcoesAnos', 'recurso', 'enviarRecurso', 'imprimirRecurso']);
    }

    public function initialize()
    {
        parent::initialize();

        if (($this->request->getParam(['action']) == 'login')
            || ($this->request->getParam(['action']) == 'add')
            || ($this->request->getParam(['action']) == 'index')
            || ($this->request->getParam(['action']) == 'view')
            || ($this->request->getParam(['action']) == 'recurso')
            || ($this->request->getParam(['action']) == 'enviarRecurso')
            || ($this->request->getParam(['action']) == 'imprimir')
        ) {
            $this->viewBuilder()->setLayout('default');
        } else if ($this->request->getParam(['action']) == 'imprimir') {
            $this->viewBuilder()->setLayout('login');
        }
        // if ($this->Auth->user('sistema') == 1) {
        // }
    }
    public function home($resp_id = null)
    {
        $this->loadModel('Eventos');
        $this->loadModel('Responsavels');
        $anoAtual = date('Y');
        $dataAtual = new DateTime();

        $dtInsc = $this->Eventos->find()
            ->where(['ano_evento' => $anoAtual, 'id' => 1])
            ->first();
        $dtDoc = $this->Eventos->find()
            ->where(['ano_evento' => $anoAtual, 'id' => 2])
            ->first();
        $dtRec = $this->Eventos->find()
            ->where(['ano_evento' => $anoAtual, 'id' => 3])
            ->first();

        $inicioInscr = DateTime::createFromFormat('d/m/Y', $dtInsc->dt_inicio);
        $fimInscr = DateTime::createFromFormat('d/m/Y', $dtInsc->dt_fim);

        if ($resp_id != null) {
            $responsavel = $this->Responsavels->find()
                ->where(['id' => $resp_id])
                ->first();
            $this->set(compact('responsavel'));
        }

        if ($dataAtual >= $inicioInscr && $dataAtual <= $fimInscr) {
            $prazoInscr = true;
        } else {
            $prazoInscr = false;
        }
        $this->set(compact('prazoInscr'));
    }
    public function homeTransporte()
    {
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam(('action'));

        return true;
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($id = null, $aux = false)
    {
        // Se o Sistema passa por essa função é por que
        // tem mais de um candidato ligado ao responsável
        $this->loadModel('TpEventos');
        $this->loadModel('Eventos');
        $this->loadModel('Inscricoes');

        if ($aux == 3) { // Verificar qual candidato tem Recurso e exibir só os que tem ic_recurso == 1
            $inscricaos = $this->Candidatos->Inscricoes->find()
                ->where(['responsavel_id' => $id, 'ic_recurso' => 1])
                ->all();
            $inscrCount = $inscricaos->count();
            $candidatos = $this->Candidatos->find('all', [
                'conditions' => ['responsavel_id' => $id]
            ]);

            if ($inscrCount == 0) {
                $this->Flash->error('Inscricao não Localizada.');
                return $this->redirect($this->referer());
            } elseif ($inscrCount >= 1) {
                // $this->loadModel('Inscricoes');
                $inscricaos = $this->Inscricoes->find()
                    ->where(['Inscricoes.responsavel_id' => $id, 'Inscricoes.ic_recurso' => 1])
                    ->contain(['Candidatos'])
                    ->all();

                $this->set([
                    'candidatos' => $inscricaos,
                    'aux' => $aux
                ]);
            }
        } elseif ($aux == 1 || $aux == 2) { // Aux = 1 -> Responsável já está cadastrado e quer cadastrar outro candidato 
            $tp_eventos = $this->TpEventos->find()
                ->where(['nm_tp_evento LIKE' => '%Inscrição%'])
                ->first();

            $ano = date('Y');

            $evento = $this->Eventos->find()
                ->where(['tp_eventos_id' => $tp_eventos->id, 'ano_evento' => $ano])
                ->first();

            // $candidatos = $this->Candidatos->Inscricoes->find('all', [
            //     'conditions' => ['Inscricoes.responsavel_id' => $id]
            // ])->contain(['Candidatos']);

            $inscricaos = $this->Candidatos->Inscricoes->find()
                ->where(['Inscricoes.responsavel_id' => $id, 'Inscricoes.evento_id' => $evento->id])
                ->contain(['Candidatos'])
                ->all();
            $this->set([
                'candidatos' => $inscricaos,
                'aux' => $aux
            ]);
        } elseif ($aux == 2) {
        }
    }



    public function indexAdmin()
    {

        $candidatos = $this->paginate($this->Candidatos, ['limit' => 20, 'order' => ['nm_candidato' => 'ASC']]);

        $this->set(compact('candidatos'));
    }

    public function search($encerrado = false)
    {
        /* SEDUC DPID - Flavia Silva 47093 em 20/01/2021 */
        // $this->viewBuilder()->setLayout('pesquisalayout');
        $this->viewBuilder()->setLayout(false);
        $pesquisa = true;
        $keyword = $this->request->getQuery('keyword');
        if ($keyword != '') :
            $query = $this->Candidatos->find()
                ->where([
                    'OR' => [
                        ['Upper(nm_candidato) LIKE' => '%' . mb_strtoupper($keyword) . '%'],
                        [
                            'Upper(nm_mae) LIKE' => '%' . mb_strtoupper($keyword) . '%'
                        ]
                    ],
                ])->contain(['Escolas', 'Anos']);

            $this->set([
                'candidatos' => $this->paginate($query),
                'keyword' => $keyword,
                'pesquisa' => $pesquisa
            ]);
        endif;
    }


    public function searchClass($encerrado = false)
    {
        /* SEDUC DPID - Flavia Silva 47093 em 20/01/2021 */
        $this->viewBuilder()->setLayout(false);
        $keyword = $this->request->getQuery('keyword');
        if ($keyword != '') :
            $query = $this->Candidatos->find('all', [
                'conditions' => [
                    'Upper(nm_candidato) LIKE' => '%' . mb_strtoupper($keyword) . '%'
                ],
                'limit' => 20
            ])->contain(['Escolas', 'Anos']);
            $this->set([
                'candidatos' => $this->paginate($query),
                'keyword' => $keyword
            ]);
        endif;
    }

    /**
     * View method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $aux = null)
    {
        $this->loadModel('TpEventos');
        $this->loadModel('Eventos');
        $this->loadModel('Inscricoes');
        $this->loadModel('Escolas');

        $candidato = $this->Candidatos->find()
            ->where(['id' => $id])
            ->first();


        $candidato = $this->Candidatos->get($candidato->id, [
            'contain' => ['Responsavels', 'Escolas', 'Tipos', 'Anos']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());

            $responsavel = $this->Candidatos->Responsavels->patchEntity($candidato->responsavel, $this->request->getData());
            $responsavel->concessao_escola = $responsavel->concessao_escola;

            $this->Candidatos->save($candidato);
            $this->Candidatos->Responsavels->save($responsavel);
            $tp_eventos = $this->TpEventos->find()
                ->where(['nm_tp_evento LIKE' => '%Inscrição%'])
                ->first();

            $ano = date('Y');

            $evento = $this->Eventos->find()
                ->where(['tp_eventos_id' => $tp_eventos->id, 'ano_evento' => $ano])
                ->first();
            $candInscr = $this->Inscricoes->find()
                ->where(['candidato_id' => $candidato->id, 'evento_id' => $evento->id])
                ->first();

            if ($candInscr == null) {
                $inscricao = $this->Inscricoes->newEntity();
                $inscricao->evento_id = $evento->id;
                $inscricao->candidato_id = $candidato->id;
                $inscricao->responsavel_id = $candidato->responsavel_id;
                if ($this->Inscricoes->save($inscricao)) {
                    $this->Flash->success('informações enviadas com sucesso');
                }
            }

            return $this->redirect(['action' => 'imprimir', $candidato->id]);
        }

        $escolas = $this->Candidatos->Escolas->find('list', ['limit' => 200]);
        $tipos = $this->Candidatos->Tipos->find('list', ['limit' => 200]);
        $anos = $this->Candidatos->Anos->find('list', ['limit' => 200]);

        $this->set('candidato', $candidato);
        $this->set('escolas', $escolas);
        $this->set('tipos', $tipos);
        $this->set('anos', $anos);
    }

    public function viewAdmin($id = null)
    {
        $candidato = $this->Candidatos->get($id, [
            'contain' => ['Responsavels', 'Escolas', 'Tipos', 'Anos']
        ]);
        $this->set('candidato', $candidato);
    }

    public function receber($id = null)
    {
        $candidato = $this->Candidatos->get($id);


        $candidato->ic_recebido = 1;
        $this->Candidatos->save($candidato);

        $this->redirect(['action' => 'protocolo_entrega', $id]);
    }

    public function protocoloEntrega($id = null)
    {
        $candidato = $this->Candidatos->get($id);

        $this->set('candidato', $candidato);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $this->loadModel('Inscricoes');
        $this->loadModel('TpEventos');
        $this->loadModel('Eventos');
        $this->loadModel('Responsavels');
        $this->loadModel('Escolas');

        $candidato = $this->Candidatos->newEntity();

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

            if ($id != null) {
                $responsavel = $this->Responsavels->get($id);
            }

            if ($this->request->is('post')) {

                $nmCandidato = $this->request->getData('nm_candidato');
                $vlCtNumero = $this->request->getData('vl_ctnumero');
                $nmResp = (str_replace($this->request->getData('nm_mae'), '.', ' '));

                // $teste = 'Rui alcantara machado';
                // $teste1 = (ucwords($teste));
                // // debug($this->request->getData('nm_mae'));

                // debug($teste1);
                // die;


                $buscaCandidatoBE = $this->Candidatos->find()
                    // ->contain(['responsavels'])
                    ->where([
                        'nm_candidato like' => '%' . $nmCandidato . '%',
                        'vl_ctnumero' => $vlCtNumero,
                        // '(replace(nm_mae,".", " ")) like' => '%' . $nmResp . '%'
                        // 'nm_mae like' => '%' . $nmResp . '%'
                    ])
                    ->first();

                if ($buscaCandidatoBE != '') {
                    $this->Flash->error('Candidato já possui cadastro.');
                    return $this->redirect(['action' => 'view', $buscaCandidatoBE->id]);
                }

                $buscaCandidato = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                    ->select(['id', 'nm_candidato', 'nm_mae'])->from('candidatos')
                    ->where([
                        'nm_candidato like' => '%' . $nmCandidato . '%',
                        'vl_ctnumero' => $vlCtNumero,
                        // 'nm_mae like' => '%' . $nmResp . '%'
                    ])->execute()->fetch('assoc');

                $dadoResp = $this->request->getData(['responsavel']);
                $concessao_escola = $dadoResp['concessao_escola'];

                if ($buscaCandidato != '') {

                    $this->Flash->error('Candidato já cadastrado em outra modalidade de Bolsa.');
                    return $this->redirect(['controller' => 'pages', 'action' => 'home']);
                } else {

                    if (isset($responsavel->id)) {

                        $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());
                        $candidato->responsavel = [];
                        $candidato->responsavel_id = $responsavel->id;
                        $responsavel = $this->Responsavels->patchEntity($responsavel, $dadoResp);
                        // if ($concessao_escola !== '') {
                        //     $concessao = $concessao_escola + 0;
                        //     $responsavel->concessao_escola = $this->Escolas->find()
                        //         ->where(['id' => $concessao])
                        //         ->select(['nm_escola'])
                        //         ->first()
                        //         ->nm_escola;
                        // }
                        $this->Responsavels->save($responsavel);
                        $this->set([
                            'errodt' => ($candidato->getErrors()['dt_nascimento']['_empty'] ?? ''),
                            'erroanoant' => ($candidato->getErrors()['ic_ano_anterior']['_empty'] ?? ''),
                            'erroicdef' => ($candidato->getErrors()['ic_deficiente']['_empty'] ?? ''),

                            'errotermo' => ('Campo necessário.')
                        ]);
                    } else {
                        $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());

                        $this->set([
                            'errodt' => ($candidato->getErrors()['dt_nascimento']['_empty'] ?? ''),
                            'erroanoant' => ($candidato->getErrors()['ic_ano_anterior']['_empty'] ?? ''),
                            'erroicdef' => ($candidato->getErrors()['ic_deficiente']['_empty'] ?? ''),
                            'errodsprof' => ($candidato['responsavel']->getErrors()['ds_profissao']['_empty'] ?? ''),
                            'errotermo' => ('Campo necessário.')
                        ]);
                    }

                    $vl_cpf =  $this->request->getData('vl_cpf');

                    $retorno = $this->Candidatos->Responsavels->find()
                        ->where(['vl_cpf LIKE' => $vl_cpf])
                        ->first();

                    if ($this->Candidatos->save($candidato)) {

                        $tp_eventos = $this->TpEventos->find()
                            ->where(['nm_tp_evento LIKE' => '%Inscrição%'])
                            ->first();

                        $ano = date('Y');

                        $evento = $this->Eventos->find()
                            ->where(['tp_eventos_id' => $tp_eventos->id, 'ano_evento' => $ano])
                            ->first();

                        $inscricao = $this->Inscricoes->newEntity();
                        $inscricao->evento_id = $evento->id;
                        $inscricao->candidato_id = $candidato->id;
                        $inscricao->responsavel_id = $candidato->responsavel_id;
                        $inscricao->pontos = $candidato->ds_moradia + $candidato->ds_dependentes + $candidato->ds_rendafamiliar + $candidato->ds_transporte;

                        if ($this->Inscricoes->save($inscricao)) {
                            $this->Flash->success('informações enviadas com sucesso');
                        }

                        return $this->redirect(['action' => 'imprimir', $candidato->id]);
                    }
                }
            }
        } else {
            $this->Flash->error('Fora do Período de Inscrição.');
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }

        $escolas = $this->Candidatos->Escolas->find('list', ['limit' => 200])->where(['ic_ativo' => 1]);
        $tipos = $this->Candidatos->Tipos->find('list', ['limit' => 200]);
        $anos = $this->Candidatos->Anos->find('list', ['limit' => 200]);
        $this->set(compact('candidato', 'responsavel', 'escolas', 'tipos', 'anos'));
    }

    public function addCand($id = null)
    {
        $this->loadModel('Inscricoes');
        $this->loadModel('TpEventos');
        $this->loadModel('Eventos');
        $this->loadModel('Responsavels');
        $this->loadModel('Escolas');

        $candidato = $this->Candidatos->newEntity();

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

            if ($id != null) {
                $responsavel = $this->Responsavels->get($id);
            }

            if ($this->request->is('post')) {

                $nmCandidato = $this->request->getData('nm_candidato');
                $vlCtNumero = $this->request->getData('vl_ctnumero');
                $nmResp = (str_replace($this->request->getData('nm_mae'), '.', ' '));


                $buscaCandidatoBE = $this->Candidatos->find()
                    // ->contain(['responsavels'])
                    ->where([
                        'nm_candidato like' => '%' . $nmCandidato . '%',
                        'vl_ctnumero' => $vlCtNumero,
                        // '(replace(nm_mae,".", " ")) like' => '%' . $nmResp . '%'
                        // 'nm_mae like' => '%' . $nmResp . '%'
                    ])
                    ->first();

                if ($buscaCandidatoBE != '') {
                    $this->Flash->error('Candidato já possui cadastro.');
                    return $this->redirect(['action' => 'view', $buscaCandidatoBE->id]);
                }

                $buscaCandidato = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                    ->select(['id', 'nm_candidato', 'nm_mae'])->from('candidatos')
                    ->where([
                        'nm_candidato like' => '%' . $nmCandidato . '%',
                        'vl_ctnumero' => $vlCtNumero,
                        // 'nm_mae like' => '%' . $nmResp . '%'
                    ])->execute()->fetch('assoc');

                $dadoResp = $this->request->getData(['responsavel']);
                $concessao_escola = $dadoResp['concessao_escola'];

                if ($buscaCandidato != '') {

                    $this->Flash->error('Candidato já cadastrado em outra modalidade de Bolsa.');
                    return $this->redirect(['controller' => 'pages', 'action' => 'home']);
                } else {

                    if (isset($responsavel->id)) {

                        $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());
                        // $candidato->responsavel = [];
                        $candidato->responsavel_id = $responsavel->id;
                        $responsavel = $this->Responsavels->patchEntity($responsavel, $dadoResp);
                        // if ($concessao_escola !== '') {
                        //     $concessao = $concessao_escola + 0;
                        //     $responsavel->concessao_escola = $this->Escolas->find()
                        //         ->where(['id' => $concessao])
                        //         ->select(['nm_escola'])
                        //         ->first()
                        //         ->nm_escola;
                        // }
                        $this->Responsavels->save($responsavel);
                        $this->set([
                            'errodt' => ($candidato->getErrors()['dt_nascimento']['_empty'] ?? ''),
                            'erroanoant' => ($candidato->getErrors()['ic_ano_anterior']['_empty'] ?? ''),
                            'erroicdef' => ($candidato->getErrors()['ic_deficiente']['_empty'] ?? ''),

                            'errotermo' => ('Campo necessário.')
                        ]);
                    } else {
                        $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());

                        $this->set([
                            'errodt' => ($candidato->getErrors()['dt_nascimento']['_empty'] ?? ''),
                            'erroanoant' => ($candidato->getErrors()['ic_ano_anterior']['_empty'] ?? ''),
                            'erroicdef' => ($candidato->getErrors()['ic_deficiente']['_empty'] ?? ''),
                            'errodsprof' => ($candidato['responsavel']->getErrors()['ds_profissao']['_empty'] ?? ''),
                            'errotermo' => ('Campo necessário.')
                        ]);
                    }

                    $vl_cpf =  $this->request->getData('vl_cpf');

                    $retorno = $this->Candidatos->Responsavels->find()
                        ->where(['vl_cpf LIKE' => $vl_cpf])
                        ->first();

                    if ($this->Candidatos->save($candidato)) {

                        $tp_eventos = $this->TpEventos->find()
                            ->where(['nm_tp_evento LIKE' => '%Inscrição%'])
                            ->first();

                        $ano = date('Y');

                        $evento = $this->Eventos->find()
                            ->where(['tp_eventos_id' => $tp_eventos->id, 'ano_evento' => $ano])
                            ->first();

                        $inscricao = $this->Inscricoes->newEntity();
                        $inscricao->evento_id = $evento->id;
                        $inscricao->candidato_id = $candidato->id;
                        $inscricao->responsavel_id = $candidato->responsavel_id;
                        $inscricao->pontos = $candidato->ds_moradia + $candidato->ds_dependentes + $candidato->ds_rendafamiliar + $candidato->ds_transporte;

                        if ($this->Inscricoes->save($inscricao)) {
                            $this->Flash->success('informações enviadas com sucesso');
                        }

                        return $this->redirect(['action' => 'imprimir', $candidato->id]);
                    }
                }
            }
        } else {
            $this->Flash->error('Fora do Período de Inscrição.');
            return $this->redirect(['controller' => 'pages', 'action' => 'home']);
        }

        $escolas = $this->Candidatos->Escolas->find('list', ['limit' => 200])->where(['ic_ativo' => 1]);
        $tipos = $this->Candidatos->Tipos->find('list', ['limit' => 200]);
        $anos = $this->Candidatos->Anos->find('list', ['limit' => 200]);
        $this->set(compact('candidato', 'responsavel', 'escolas', 'tipos', 'anos'));
    }


    public function opcoesTipos()
    {
        $this->loadModel('Escolas');
        $this->loadModel('EscolasTipos');
        $resultados = $this->EscolasTipos->find()
            ->where(['escola_id' => $_GET['id']])
            ->join([
                'table' => 'tipos',
                'alias' => 'Tipo',
                'type' => 'INNER',
                'conditions' => 'Tipo.id = EscolasTipos.tipo_id'
            ])
            ->select(['Tipo.id', 'Tipo.nm_tipo']);
        foreach ($resultados as $r) $tipos[$r->Tipo['id']] = $r->Tipo['nm_tipo'];
        $this->set(compact('tipos'));
    }

    public function opcoesAnos()
    {
        $this->loadModel('Anos');
        $this->loadModel('EscolasTiposAnos');
        $anos = array();

        // debug($_GET['id']);
        // die;

        $buscaAnos = $this->EscolasTiposAnos->find()
            ->where(['escolas_tipo_id' => $_GET['id']])
            ->join([
                'table' => 'anos',
                'alias' => 'Ano',
                'type' => 'INNER',
                'conditions' => 'Ano.id = EscolasTiposAnos.ano_id'
            ])
            ->select(['nm_ano']);
        $i = 0;
        foreach ($buscaAnos as $ano) $anos[$i++] = $ano['nm_ano'];
        $this->set(compact('anos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $candidato = $this->Candidatos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());
            if ($this->Candidatos->save($candidato)) {
                $this->Flash->success(__('As informações do candidato foram alteradas.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('As informações do candidato  não foram alteradas. Por favor, tente novamente.'));
        }
        $responsavels = $this->Candidatos->Responsavels->find('list', ['limit' => 200]);
        $escolas = $this->Candidatos->Escolas->find('list', ['limit' => 200]);
        $tipos = $this->Candidatos->Tipos->find('list', ['limit' => 200]);
        $anos = $this->Candidatos->Anos->find('list', ['limit' => 200]);
        $this->set(compact('candidato', 'responsavels', 'escolas', 'tipos', 'anos'));
    }

    public function editAdmin($id = null)
    {
        $candidato = $this->Candidatos->get($id, [
            'contain' => ['Responsavels', 'Escolas', 'Tipos', 'Anos']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());
            $responsavel = $candidato->responsavel;

            $auxNumero = $this->request->getData('vl_ctnumero');

            switch (strlen($auxNumero)) {
                case 2:
                    $candidato->vl_ctnumero = "00000" . $auxNumero;
                    break;
                case 3:
                    $candidato->vl_ctnumero = "0000" . $auxNumero;
                    break;
                case 4:
                    $candidato->vl_ctnumero = "000" . $auxNumero;
                    break;
                case 5:
                    $candidato->vl_ctnumero = "00" . $auxNumero;
                    break;
                case 6:
                    $candidato->vl_ctnumero = "0" . $auxNumero;
                    break;
            }

            if (strlen($this->request->getData('vl_ctlivro')) < 3) {
                $aux = ($this->request->getData('vl_ctlivro'));
                $candidato->vl_ctlivro = str_replace($aux, '00' . $aux, $aux);
            }

            if (strlen($this->request->getData('vl_ctfolha')) < 3) {
                $auxFolha = $this->request->getData('vl_ctfolha');
                $candidato->vl_ctfolha = "0" . $auxFolha;
            }

            if ($this->Candidatos->save($candidato)) {
                if ($this->Candidatos->Responsavels->save($responsavel));
                $this->Flash->success(__('Cadastrado alterado com sucesso.'));
                $this->redirect(['action' => 'index_admin']);
            } else {
                $this->Flash->error('Não Foi possível alterar.');
            }
        }

        $escolas = $this->Candidatos->Escolas->find('list', ['limit' => 200]);
        $tipos = $this->Candidatos->Tipos->find('list', ['limit' => 200]);
        $anos = $this->Candidatos->Anos->find('list', ['limit' => 200]);

        $this->set('candidato', $candidato);
        $this->set('escolas', $escolas);
        $this->set('tipos', $tipos);
        $this->set('anos', $anos);
    }

    /**
     * Delete method
     *
     * @param string|null $id Candidato id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $candidato = $this->Candidatos->get($id);
        if ($this->Candidatos->delete($candidato)) {
            $this->Flash->success(__('Candidato excluído.'));
        } else {
            $this->Flash->error(__('O candidato não pode ser excluído. Tente Novamente.'));
        }

        return $this->redirect(['action' => 'indexAdmin']);
    }

    public function login()
    {
        $this->loadModel('Responsavels');
        $this->loadModel('Eventos');
        $this->loadModel('TpEventos');

        if ($this->request->is('post')) {
            $ano = date('Y');

            $tp_eventos = $this->TpEventos->find()
                ->where(['nm_tp_evento LIKE' => '%Inscrição%'])
                ->first();

            $evento = $this->Eventos->find()
                ->where(['tp_eventos_id' => $tp_eventos->id, 'ano_evento' => $ano])
                ->first();

            $usuarios = $this->request->getData();
            $aux = $this->request->getData(['aux']);

            $vl_cpf = $this->request->getData(['vl_cpf']);
            $dt_nasc = $this->request->getData(['dt_nascimento']);

            if ($dt_nasc != "") {
                $corrige = explode("/", $dt_nasc);
                $corrige = $corrige[2] . "-" . $corrige[1] . "-" . $corrige[0];

                $dt_nasc = $corrige;
            }

            if ($aux == 4) {
                $usuarios = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                    ->select(['id', 'vl_cpf', 'dt_nascimento'])->from('responsavels')
                    ->where([
                        'vl_cpf' => $vl_cpf,
                        'dt_nascimento' => $dt_nasc
                    ])->execute()->fetch('assoc');

                if ($usuarios != null) {
                    $candidatos =  ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                        ->select(['id', 'nm_candidato', 'responsavel_id'])->from('candidatos')
                        ->where(['responsavel_id' => $usuarios['id']])
                        ->execute()->fetch('assoc');

                    $inscricaos = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                        ->select(['id', 'candidato_id', 'responsavel_id'])->from('inscricoes')
                        // $this->Candidatos->Inscricoes->find()
                        ->where(['responsavel_id' => $usuarios['id'], 'evento_id' => $evento->id])
                        ->execute()->fetchAll('assoc');

                    if ($inscricaos == '') {
                        $this->Flash->error('Responsável não tem inscrição concluída.');
                        return $this->redirect($this->referer());
                    } else {
                        $this->redirect(['controller' => '../bolsaatleta/candidatos', 'action' => 'index', $usuarios['id'], $aux]);
                    }
                } else {
                    $this->Flash->error('Responsável não localizado.');
                    return $this->redirect($this->referer());
                }
            } else if ($aux == 5) {
                $usuarios = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                    ->select(['id', 'vl_cpf', 'dt_nascimento'])->from('responsavels')
                    ->where([
                        'vl_cpf' => $vl_cpf,
                        'dt_nascimento' => $dt_nasc
                    ])->execute()->fetch('assoc');

                if ($usuarios != null) {

                    $inscricaos = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                        ->select(['id', 'candidato_id', 'responsavel_id'])->from('inscricoes')
                        ->where(['responsavel_id' => $usuarios['id'], 'evento_id' => $evento->id])
                        ->execute()->fetchAll('assoc');

                    if ($inscricaos == '') {
                        $this->Flash->error('Responsável não tem inscrição concluída.');
                        return $this->redirect($this->referer());
                    } else {
                        $this->redirect(['controller' => '../bolsaatleta/candidatos', 'action' => 'index', $usuarios['id'], $aux]);
                    }
                } else {
                    $this->Flash->error('Responsável não localizado.');
                    return $this->redirect($this->referer());
                }
            } else if ($aux == 6) {
                $usuarios = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                    ->select(['id', 'vl_cpf', 'dt_nascimento'])->from('responsavels')
                    ->where([
                        'vl_cpf' => $vl_cpf,
                        'dt_nascimento' => $dt_nasc
                    ])->execute()->fetch('assoc');

                $inscricao = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                    ->select(['id', 'evento_id', 'candidato_id', 'responsavel_id', 'ic_recurso'])->from('inscricoes')
                    ->where([
                        'responsavel_id' => $usuarios['id'],
                        'evento_id' => $evento->id,
                        'ic_recurso' => 1
                    ])->execute()->fetch('assoc');

                if ($inscricao != '') {
                    $candidatos = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
                        ->select(['id', 'responsavel_id'])->from('candidatos')
                        ->where([
                            'responsavel_id' => $usuarios['id'],
                            'id' => $inscricao['candidato_id']
                        ])->execute()->fetch('assoc');

                    $impressao = 1;
                    $this->redirect(['controller' => '../bolsaatleta/candidatos', 'action' => 'enviarRecurso', $inscricao['candidato_id'], $inscricao['id'], $impressao, $aux]);
                } else {
                    $this->Flash->error('Responsável ainda não tem Recurso para imprimir.');
                    return $this->redirect($this->referer());
                }
            } else {

                $usuarios = $this->Responsavels->find()
                    ->where([
                        'vl_cpf' => $vl_cpf,
                        'dt_nascimento' => $dt_nasc
                    ])
                    ->first();

                if ($usuarios != null) {

                    $candidatos = $this->Candidatos->find('all', [
                        'conditions' => ['responsavel_id' => $usuarios->id]
                    ]);
                    // $number = $candidatos->count();

                    $inscricao = $this->Candidatos->Inscricoes->find()
                        ->where(['responsavel_id' => $usuarios->id, 'evento_id' => $evento->id])
                        ->all();

                    $numberInscr = $inscricao->count();

                    if ($aux == 1) { // Já tem cadastro e quer fazer nova inscrição ou 
                        //Corrigir Dados Informados anteriormente
                        $this->redirect(['action' => 'index', $usuarios->id, $aux]);
                    } else if ($aux == 2) { //Já fez cadastro e quer imprimir novamente a Ficha de Inscrição
                        if ($numberInscr == 0) {
                            $this->Flash->error('Responsável não tem inscrição concluída.');
                            return $this->redirect($this->referer());
                        } else if ($numberInscr == 1) {
                            $candidatos = $this->Candidatos->Inscricoes->find()
                                ->where(['responsavel_id' => $usuarios->id])
                                ->first();

                            return $this->redirect(['action' => 'imprimir', $candidatos->candidato_id, $aux]);
                        } else if ($numberInscr > 1) {
                            $this->redirect(['action' => 'index', $usuarios->id, $aux]);
                        }
                    } else if ($aux == 3) { // Fez recurso e precisa imprimir novamente a Ficha de Recurso 

                        if ($numberInscr == 1) {
                            $inscricao = $this->Candidatos->Inscricoes->find()
                                ->where(['responsavel_id' => $usuarios->id, 'evento_id' => $evento->id, 'ic_recurso' => 1])
                                ->first();

                            if ($inscricao != '') {
                                $candidatos = $this->Candidatos->find()
                                    ->where(['responsavel_id' => $usuarios->id, 'id' => $inscricao->candidato_id])
                                    ->first();
                                $impressao = 1;
                                $this->redirect(['action' => 'enviarRecurso', $inscricao->candidato_id, $inscricao->id, $impressao, $aux]);
                            } else {
                                $this->Flash->error('Responsável ainda não tem Recurso para imprimir.');
                                return $this->redirect($this->referer());
                            }
                        } else if ($numberInscr > 1) {
                            $this->redirect(['action' => 'index', $usuarios->id, $aux]);
                        }
                    }
                } else {
                    $this->Flash->error('Responsável não localizado.');
                    return $this->redirect($this->referer());
                }
            }
        }
    }

    public function imprimir($id = null)
    {
        $this->loadModel('Documentos');
        $this->loadModel('Responsavels');
        $this->loadModel('Escolas');
        $this->loadModel('Tipos');
        $this->loadModel('Anos');
        $this->loadModel('Eventos');


        $ano = date('Y');
        $dtDoc = $this->Eventos->find()
            ->where(['ano_evento' => $ano, 'tp_eventos_id' => 2])
            ->first();

        if ($dtDoc !== null) {
            $dtInicio = $dtDoc->dt_inicio;
            $this->set('dtInicio', $dtInicio);

            $dtFim = $dtDoc->dt_fim;
            $this->set('dtFim', $dtFim);
        }

        $bolsa = $this->Candidatos->find()
            ->where(['Candidatos.id' => $id])
            ->contain(['Responsavels', 'Escolas', 'Tipos', 'Anos'])
            ->first();

        if ($bolsa->responsavel['concessao_fam'] != 3) {
            $escolaResp = $this->Escolas->find()
                ->where(['id' => $bolsa->responsavel['concessao_escola']])
                ->first();
            $this->set('escolaResp', $escolaResp);
        }

        $this->set('bolsa', $bolsa);
    }

    public function listarInscritos()
    {
        $inscritos = $this->Candidatos->find('all', [
            'select' => (['id', 'nm_candidato'])
        ])->order(['nm_candidato' => 'ASC']);
        $this->set('inscritos', $inscritos);
    }

    public function classificacao()
    {

        if (!empty($this->request->getData())) {
        } else {
            $bolsas = $this->paginate($this->Candidatos->find(), ['limit' => 30]);

            $candidatos = $this->paginate($this->Candidatos->find()->contain(['Escolas', 'Anos']), ['limit' => 30]);

            $this->set(compact('bolsas', 'candidatos'));
        }
    }

    public function deferir($id = null)
    {
        $candidato = $this->Candidatos->get($id, []);
        $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());

        $candidato->ic_aprovado = 1;
        if ($this->Candidatos->save($candidato)) {
            $this->Flash->success('Deferido com sucesso.');
            $this->redirect(['action' => 'classificacao']);
        } else {
            $this->Flash->error('Erro ao tentar deferir o candidato.');
        }
    }

    public function indeferir($id = null)
    {
        $candidato = $this->Candidatos->get($id, []);
        $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());


        $candidato->ic_aprovado = 0;
        if ($this->Candidatos->save($candidato)) {
            $this->Flash->success('Indeferido com sucesso.');
            $this->redirect(['action' => 'classificacao']);
        } else {
            $this->Flash->error('Erro ao tentar indeferir o candidato.');
        }
    }


    public function aprovar($id = null)
    {
        $this->loadModel('Escolas');

        $candidato = $this->Candidatos->get($id, [
            'contain' => ['Responsavels', 'Escolas', 'Tipos', 'Anos']
        ]);

        if ($candidato->responsavel->concessao_fam == 0) {
            $concessao = $this->Escolas->find()
                ->where(['nm_escola like' => '%' . $candidato->responsavel->concessao_escola])
                ->first();

            $escola = $this->Escolas->find()
                ->where(['id' => $candidato->responsavel->concessao_escola])
                ->first();
            $this->set(compact('escola'));
        }

        if ($this->request->getData()) {
            $candidato->ic_aprovado = 1;
            if ($this->Candidatos->save($candidato)) {
                $this->Flash->success('Cadastro recebido');
                $this->redirect(['action' => 'classificacao']);
            } else {
                $this->Flash->error('Erro ao atualizar cadastro.');
            }
        }

        // EM SISTEMA ANTERIOR TINHA UMA VERIFICAÇÃO CASO O FORM RETORNE VAZIO (VER SE A NECESSIDADE DE USAR ESTE MÉTODO.)
        $this->set('candidato', $candidato);
    }
    public function cancelar($id = null)
    {
        $candidato = $this->Candidatos->get($id, []);
        $candidato = $this->Candidatos->patchEntity($candidato, $this->request->getData());

        $candidato->ic_aprovado = -1;
        if ($this->Candidatos->save($candidato)) {
            $this->Flash->success('Inscrição cancelada com sucesso.');
            $this->redirect(['action' => 'classificacao']);
        } else {
            $this->Flash->error('Erro ao tentar cancelar a Inscrição.');
        }
    }

    public function recurso()
    {
        $this->loadModel('Inscricoes');
        $this->loadModel('TpEventos');
        $this->loadModel('Eventos');
        $this->loadModel('Responsavels');
        $this->loadModel('Escolas');
        //$candidato = $this->Candidatos->newEntity();
        // 

        if (!isset($validaRecurso)) {
            $validaRecurso = null;
        }

        if ($this->request->is('POST', 'PUT', 'GET', 'PATCH')) {


            $candidato = $this->Candidatos->find()
                ->where(['Candidatos.dt_nascimento' =>  $this->request->getData('dt_nascimento'), 'vl_ctnumero' => $this->request->getData('vl_numero')])
                ->contain(['Responsavels', 'Escolas'])
                ->first();

            if ($candidato) {
                if ($candidato->ic_recebido == 1) {
                    if ($candidato->ic_aprovado == 1) {
                        $validaRecurso = false;
                        $this->set(compact('validaRecurso'));
                        $this->Flash->error('Não é possível ao candidato utilizar esse recurso, situação: Deferido');
                        return $this->redirect(['controller' => 'pages', 'action' => 'home']);
                    } else if ($candidato->ic_aprovado == 0) {
                        $tp_eventos = $this->TpEventos->find()
                            ->where(['nm_tp_evento LIKE' => '%Inscrição%'])
                            ->first();

                        $ano = date('Y');

                        $evento = $this->Eventos->find()
                            ->where(['tp_eventos_id' => $tp_eventos->id, 'ano_evento' => $ano])
                            ->first();

                        $inscricao = $this->Inscricoes->find()
                            ->where(['candidato_id' => $candidato->id, 'evento_id' => $evento->id])
                            ->first();

                        if ($inscricao->ic_recurso == 1) {
                            $this->Flash->error('Candidato já deu entrada em Recurso, aguarde a devolutiva!');
                            $this->redirect(['controller' => 'pages', 'action' => 'home']);
                        } else {
                            $validaRecurso = true;
                            $this->Flash->success('Candidato Encontrado, preencha e imprima o requerimento.');
                            $this->redirect(['action' => 'enviarRecurso',  $candidato->id, $inscricao->id]);
                        }
                    } else if ($candidato->ic_aprovado == -1) {
                        $validaRecurso = false;
                        $this->set(compact('validaRecurso'));
                        $this->Flash->error('Não é possível ao candidato utilizar esse recurso, situação: Cancelado.');
                        $this->redirect(['controller' => 'pages', 'action' => 'home']);
                    }
                } else {
                    $validaRecurso = false;
                    $this->set(compact('validaRecurso'));
                    $this->Flash->error('Candidato não entregou os documentos na data prevista.', 'alerta');
                }
            } else {
                $this->Flash->error('Candidato não encontrado', 'alerta');
            }
        }

        $this->set(compact('candidato'));
    }

    public function enviarRecurso($id = null, $inscricao = null, $impressao = null, $aux = false)
    {
        $this->loadModel('Inscricoes');
        if ($impressao == null) {
            $this->set(compact('impressao'));
        }

        // debug($impressao);
        // die;

        $candidato = $this->Candidatos->find()
            ->where(['Candidatos.id' => $id])
            ->contain(['Responsavels', 'Escolas'])
            ->first();

        $inscricao = $this->Inscricoes->find()
            ->where(['id' => $inscricao])
            ->first();

        if ($aux == 3 || $aux == 6) {
            $impressao = true;
            $this->set(compact('impressao'));
        }


        if ($this->request->is('POST', 'PUT', 'GET', 'PATCH')) {
            // debug($this->request->getData());
            // die;

            $inscricao = $this->Inscricoes->patchEntity($inscricao, $this->request->getData());
            $inscricao->ic_recurso = 1;
            // debug($id);
            // debug($inscricao);
            // debug($this->request->getData());
            // die;
            if ($this->Inscricoes->save($inscricao)) {
                $this->Flash->success('Recurso enviado com sucesso.');
                $impressao = true;
                $this->set(compact('impressao'));
                // return $this->redirect(['action' => 'imprimirRecurso', $candidato->id, $inscricao->id]);
            } else {
                $this->Flash->error('Não foi possível enviar Recurso. Tente novamente mais tarde.');
                return $this->redirect($this->referer());
            }
        }

        $this->set('candidato', $candidato);
        $this->set('inscricao', $inscricao);
    }

    public function relatorios()
    {
        // $this->loadModel('Inscricoes');
        if ($this->request->getSession()->read('Auth.User')) {
            $userName = $this->request->getSession()->read('Auth.User');
        }
        $inscricao = $this->Candidatos->Inscricoes->find()
            ->where(['ic_recebido' => 1])
            ->contain(['Candidatos' => ['Escolas', 'Tipos', 'Anos']])
            ->order(['pontos' => 'DESC'])
            ->all();

        $this->set(compact('inscricao'));
        // $this->set('inscricao', $this->paginate($inscricao));
    }

    public function relatorioEscola()
    {
        $this->loadModel('Escolas');
        $this->loadModel('Inscricoes');

        if ($this->request->is('POST', 'PUT', 'GET', 'PATCH')) {

            $escolaFind = $this->Escolas->find()
                ->where(['nm_escola' => $_POST['escola']])
                ->select(['id', 'nm_escola'])->first();

            if ($escolaFind != '') {
                $candidatoPorEscolas = $this->Candidatos->Inscricoes->find()
                    ->where(['escola_id' => $escolaFind->id])
                    ->contain(['Candidatos' => ['Escolas', 'Anos']])
                    ->order(['pontos' => 'DESC'])
                    ->all();

                $this->set('candidatos', $candidatoPorEscolas);
            }
        }

        $escolas = $this->Escolas->find()->order(['nm_escola' => 'Asc'])->select(['id', 'nm_escola']);
        $this->set(compact('escolas'));
    }

    public function relatorioEscPontDefAnoInscr()
    {
        $this->loadModel('Escolas');
        $this->loadModel('Inscricoes');

        if ($this->request->is('POST', 'PUT', 'GET', 'PATCH')) {

            $escolaFind = $this->Escolas->find()
                ->where(['nm_escola' => $_POST['escola']])
                ->select(['id', 'nm_escola'])->first();


            if ($escolaFind != '') {
                $candidatoPorEscolas = $this->Candidatos->Inscricoes->find()
                    // ->where(['escola_id' => $escolaFind->id])
                    ->where(['Candidatos.ic_recebido' => 1, 'Candidatos.escola_id' => $escolaFind->id])
                    ->contain(['Candidatos' => ['Escolas', 'Anos']])
                    ->order(['pontos' => 'DESC', 'Candidatos.ic_deficiente' => 'DESC', 'Candidatos.ano_id' => 'DESC', 'Inscricoes.id' => "ASC"]);
                // ->all();

                $this->set('candidatos', $this->paginate($candidatoPorEscolas, ['limit' => 100]));
            }
        }

        $escolas = $this->Escolas->find()->order(['nm_escola' => 'Asc'])->select(['id', 'nm_escola']);
        $this->set(compact('escolas'));
    }

    public function relatorioAno()
    {
        $this->loadModel('Anos');
        $this->loadModel('Tipos');

        if ($this->request->is('POST', 'PUT', 'GET', 'PATCH')) {

            if (!isset($nmTipo)) {
                $nmTipo = $_POST['tipo'];
                $tipoFind = $this->Tipos->find()
                    ->where(['nm_tipo' => $nmTipo])
                    ->select(['id', 'nm_tipo'])->first();

                $anos = $this->Anos->find()
                    ->where(['tipo_id' => $tipoFind->id])
                    ->select(['id', 'nm_ano'])->all();

                $this->set(compact('anos', 'nmTipo'));
            }

            if ($this->request->getData(['ano'])) {
                $nmAno = $_POST['ano'];
                $anoFind = $this->Anos->find()
                    ->where(['nm_ano' => $nmAno, 'tipo_id' => $tipoFind->id])
                    ->first();

                $candidatosPorAnos = $this->Candidatos->Inscricoes->find()
                    ->where(['ano_id' => $anoFind->id])
                    ->contain(['Candidatos' => ['Escolas', 'Anos']])
                    ->order(['pontos' => 'DESC'])
                    ->all();

                $this->set('candidatos', $candidatosPorAnos);
                $this->set('nmAno', $nmAno);
            }
        }

        $tipos = $this->Tipos->find()->all();
        $this->set(compact('anos', 'tipos'));
    }
}

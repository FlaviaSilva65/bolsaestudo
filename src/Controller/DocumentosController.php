<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;

use Cake\Event\Event;

/**
 * Documentos Controller
 *
 * @property \App\Model\Table\DocumentosTable $Arquivos
 *
 * @method \App\Model\Entity\Arquivo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DocumentosController extends AppController
{
    // public function beforeFilter(Event $event)
    // {
    //     parent::beforeFilter($event);

    //     $this->Auth->allow(['add', 'index']);
    // }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        if (in_array($action, ['add', 'index', 'delete'])) {
            return true;
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $arquivos = $this->paginate($this->Documentos);

        $this->set(compact('arquivos'));
    }

    /**
     * View method
     *
     * @param string|null $id Arquivo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $arquivos = $this->Documentos->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('arquivos', $arquivos);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arquivo = $this->Documentos->newEntity();
        $user = $this->Auth->user();

        if ($this->request->is('post')) {
            // debug($this->request->getData()); //['nm_arquivo']['size']);
            // debug($user['id']);

            $filesize = $this->request->getData()['nm_arquivo']['size'];
            $erro = $this->request->getData()['nm_arquivo']['error'];
            if ($erro == 0) {
                // echo ('Erro Zero');

                if ($filesize > 2097152) {
                    $this->Flash->error('Tamanho do arquivo maior que 2MB!');
                    $this->redirect($this->referer());
                } else {
                    $arquivo = $this->Documentos->patchEntity($arquivo, $this->request->getData());
                    // $arquivo->nm_arquivo = $this->tirarAcentos($this->request->getData()['nm_arquivo']['name']);

                    $arquivo->user_id = $user['id'];
                    // debug($arquivo);


                    $filename = $this->request->getData()['nm_arquivo']['name'];
                    // $filename = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0080-\u7fff] remove', $filename);
                    // $filename = transliterator_transliterate('Any-Latin; Latin-ASCII; [\u0080-\u7fff] remove', $filename);
                    // $filename = $filename->getClientFilename();
                    // $filename = $this->tirarAcentos($filename);
                    // debug($filename);
                    // die;

                    $file_tmp_name = $this->request->getData()['nm_arquivo']['tmp_name'];
                    // debug($file_tmp_name);

                    $caminho = WWW_ROOT . 'arquivos';
                    // debug($caminho);

                    $allowed = array('pdf');
                    $file = $this->Documentos->find()->last();
                    // debug($file);
                    // die;
                    if ($file !== null) {
                        $fileid = $file->id + 1;
                    } else {
                        $fileid =  1;
                    }
                    // $fileid = $file->id + 1;
                    $newName = explode(".pdf", $this->request->getData()['nm_arquivo']['name']);
                    $arquivo->nm_arquivo = $newName[0] . $fileid . '.pdf';
                    // debug($fileid);
                    // debug(substr(strrchr($filename, '.'), 1));
                    // die;

                    if ($this->Documentos->save($arquivo)) {
                        if (is_dir($caminho) == false) {
                            $dir = new Folder($caminho, true, 0777);
                            // debug($dir);
                            // die;

                            if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                                throw new ExceptionNotFoundException('Tipo de Documento não permitido.', 1);
                            } elseif (is_uploaded_file($file_tmp_name)) {
                                move_uploaded_file($file_tmp_name, $caminho . DS . $arquivo->nm_arquivo);
                                // $filename->moveTo([$caminho, $filename]);
                                return $this->redirect(['action' => 'index']);
                            }
                        } else {
                            if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                                throw new ExceptionNotFoundException('Tipo de Documento não permitido.', 1);
                            } elseif (is_uploaded_file($file_tmp_name)) {
                                // debug($arquivo);
                                // die;
                                move_uploaded_file($file_tmp_name, $caminho . DS . $arquivo->nm_arquivo);
                                // $filename->moveTo([$caminho, $filename]);

                                // die;
                            }
                        }
                    }
                    $this->redirect(['controller' => 'Documentos', 'action' => 'index']);
                    // die;
                    // return $this->redirect(['controller' => 'Arquivos', 'action' => 'index']);
                }
            } else {
                $this->redirect($this->referer());
            }
            // die;
        }
        $tipos = (['abertura' => 'Abertura', 'classificacao' => 'Classificação', 'esclarecimento' => 'Esclarecimentos']);
        $this->set(compact('arquivo', 'tipos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Arquivo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $arquivo = $this->Documentos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $arquivo = $this->Documentos->patchEntity($arquivo, $this->request->getData());
            // debug($this->request->getData());
            // debug($arquivo);
            // die;
            if ($this->Documentos->save($arquivo)) {
                $this->Flash->success(__('The arquivo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arquivo could not be saved. Please, try again.'));
        }
        $users = $this->Documentos->Users->find('list', ['limit' => 200]);
        $tipos = $tipos = (['abertura' => 'Abertura', 'classificacao' => 'Classificação', 'esclarecimento' => 'Esclarecimentos']);
        $this->set(compact('arquivo', 'users', 'tipos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Arquivo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $arquivo = $this->Documentos->get($id);
        if (file_exists(WWW_ROOT . 'arquivos' . DS . $arquivo->nm_arquivo))
            unlink(WWW_ROOT . 'arquivos' . DS . $arquivo->nm_arquivo);
        if ($this->Documentos->delete($arquivo)) {
            $this->Flash->success('Arquivo excluído com sucesso.');
        } else {
            $this->Flash->error('O Arquivo não pode ser excluído.');
        }

        $this->redirect($this->referer());
    }

    public function tirarAcentos($string)
    {
        //Declara a função e recebe o parâmetro $string.
        //Abaixo é usado str_replace em cada vogal ou consuante com acento que será retirado o acento.
        //Além de retirar o acento, retorna a informação na mesma variável $string.
        $string = str_replace('ã', 'a', $string);
        $string = str_replace('á', 'a', $string);
        $string = str_replace('Ã', 'A', $string);
        $string = str_replace('Á', 'A', $string);
        $string = str_replace('ç', 'c', $string);
        $string = str_replace('Ç', 'C', $string);
        $string = str_replace('ẽ', 'e', $string);
        $string = str_replace('é', 'e', $string);
        $string = str_replace('Ẽ', 'E', $string);
        $string = str_replace('É', 'E', $string);
        $string = str_replace('í', 'i', $string);
        $string = str_replace('Í', 'I', $string);
        $string = str_replace('ó', 'o', $string);
        $string = str_replace('Ó', 'O', $string);
        $string = str_replace('Ú', 'U', $string);
        $string = str_replace('ú', 'u', $string);
        //No final retorna a variável com o texto sem acento.
        return $string;
    }
}

<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(...$path)
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        $this->loadModel('Documentos');

        $edital = $this->Documentos->find()
            ->where(['tp_edital like' => 'abertura'])
            ->last();

        $esclarecimento = $this->Documentos->find()
            ->where(['tp_edital like' => 'esclarecimento'])
            ->last();

        $classificacao = $this->Documentos->find()
            ->where(['tp_edital like' => 'classificacao'])
            ->last();

        $this->set(compact('edital', 'esclarecimento', 'classificacao'));

        $this->loadModel('Eventos');
        // $ano = date('Y');
        $hoje = date('Y-m-d');

        // Aqui se verifica se está dentro do prazo para inscrição
        $evento = $this->Eventos->find()
            ->where(['tp_eventos_id' => 1])
            ->last();

        $data_inscr = $evento['dt_inicio'];

        $ano = $data_inscr->format('Y');

        if ($hoje >= date_format($evento['dt_inicio'], 'Y-m-d')) {
            $inscrInicio = true;
        } else {
            $inscrInicio = false;
        }

        if ($hoje <= date_format($evento['dt_fim'], 'Y-m-d')) {
            $inscrFim = true;
        } else {
            $inscrFim = false;
        }

        if ($inscrInicio == true && $inscrFim == true) {
            $inscricao = true;
            $this->set(compact('inscricao'));
        }

        $eventoBolsaAtleta = ConnectionManager::get('bancoBolsaAtleta')->newQuery()
            ->select(['tp_eventos_id', 'ano_evento', 'dt_inicio', 'dt_fim'])->from('eventos')
            ->where(['tp_eventos_id' => 1])->execute()->fetch('assoc');


        // if (strtotime($hoje) >= strtotime($eventoBolsaAtleta['dt_inicio'])) {
        if ($hoje >= $eventoBolsaAtleta['dt_inicio']) {
            $inscrInicioBAtleta = true;
        } else {
            $inscrInicioBAtleta = false;
        }


        // if ($hoje >= date_format($eventoBolsaAtleta['dt_fim'], 'Y-m-d')) {
        if ($hoje <= $eventoBolsaAtleta['dt_fim']) {
            $inscrFimBAtleta = true;
        } else {
            $inscrFimBAtleta = false;
        }

        if ($inscrInicioBAtleta == true && $inscrFimBAtleta == true) {
            $inscricaoBAtleta = true;
            $this->set(compact('inscricaoBAtleta'));
        }

        // Aqui se verifica se está dentro do prazo para recurso
        $eventoRecurso = $this->Eventos->find()
            ->where(['tp_eventos_id' => 3, 'ano_evento' => $ano])
            ->first();

        // if (strtotime($hoje) >= strtotime($evento['dt_inicio'])) {
        if ($hoje >= date_format($eventoRecurso['dt_inicio'], 'Y-m-d')) {
            $recursoInicio = true;
        } else {
            $recursoInicio = false;
        }

        // if (strtotime($hoje) <= strtotime($eventoRecurso['dt_fim'])) {
        // if ($hoje <= $eventoRecurso['dt_fim']) {
        if ($hoje <= date_format($eventoRecurso['dt_fim'], 'Y-m-d')) {
            $recursoFim = true;
        } else {
            $recursoFim = false;
        }

        if ($recursoInicio == true && $recursoFim == true) {
            $recurso = true;
            $this->set(compact('recurso'));
        }

        $recursoBolsaAtleta =  ConnectionManager::get('bancoBolsaAtleta')->newQuery()->select(['tp_eventos_id', 'ano_evento', 'dt_inicio', 'dt_fim'])->from('eventos')
            ->where(['tp_eventos_id' => 3])->execute()->fetch('assoc');

        if (strtotime($hoje) >= strtotime($recursoBolsaAtleta['dt_inicio'])) {
            $recursoBAInicio = true;
        } else {
            $recursoBAInicio = false;
        }
        if (strtotime($hoje) <= strtotime($recursoBolsaAtleta['dt_fim'])) {
            $recursoBAFim = true;
        } else {
            $recursoBAFim = false;
        }

        if ($recursoBAInicio == true && $recursoBAFim == true) {
            $recursoBA = true;
            $this->set(compact('recursoBA'));
        }

        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}

<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Candidato Entity
 *
 * @property int $id
 * @property string $nm_candidato
 * @property int $responsavel_id
 * @property int $escola_id
 * @property string $tipo_id
 * @property string $ano_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $ic_deletado
 * @property int $ic_ano_anterior
 * @property int $ic_recebido
 * @property int|null $ic_aprovado
 * @property int|null $vl_ctnumero
 * @property string|null $vl_ctlivro
 * @property string|null $vl_ctfolha
 * @property \Cake\I18n\FrozenDate $dt_nascimento
 * @property string|null $vl_rg
 * @property string|null $nm_mae
 * @property string|null $nm_pai
 * @property string|null $nm_rua
 * @property string|null $vl_numero
 * @property string|null $nm_bairro
 * @property string|null $nm_cidade
 * @property string|null $vl_cep
 * @property string|null $vl_tel
 * @property string|null $periodo
 * @property string|null $vl_cel
 * @property int|null $ds_moradia
 * @property int|null $ds_dependentes
 * @property int|null $ds_rendafamiliar
 * @property int|null $ds_transporte
 * @property string|null $ds_info_compl
 * @property string|null $ds_recebeobs
 * @property bool $ic_deficiente
 * @property int $ic_recurso
 * @property string|null $ds_motivo_recurso
 *
 * @property \App\Model\Entity\Responsavel $responsavel
 * @property \App\Model\Entity\Escola $escola
 * @property \App\Model\Entity\Tipo $tipo
 * @property \App\Model\Entity\Ano $ano
 * @property \App\Model\Entity\Inscrico[] $inscricoes
 */
class Candidato extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nm_candidato' => true,
        'responsavel_id' => true,
        'escola_id' => true,
        'tipo_id' => true,
        'ano_id' => true,
        'created' => true,
        'modified' => true,
        'ic_deletado' => true,
        'ic_ano_anterior' => true,
        'ic_recebido' => true,
        'ic_aprovado' => true,
        'vl_ctnumero' => true,
        'vl_ctlivro' => true,
        'vl_ctfolha' => true,
        'dt_nascimento' => true,
        'vl_rg' => true,
        'nm_mae' => true,
        'nm_pai' => true,
        'nm_rua' => true,
        'vl_numero' => true,
        'nm_bairro' => true,
        'nm_cidade' => true,
        'vl_cep' => true,
        'vl_tel' => true,
        'periodo' => true,
        'vl_cel' => true,
        'ds_moradia' => true,
        'ds_dependentes' => true,
        'ds_rendafamiliar' => true,
        'ds_transporte' => true,
        'ds_info_compl' => true,
        'ds_recebeobs' => true,
        'ic_deficiente' => true,
        'ic_recurso' => true,
        'ds_motivo_recurso' => true,
        'responsavel' => true,
        'escola' => true,
        'tipo' => true,
        'ano' => true,
        'inscricoes' => true,
    ];
}

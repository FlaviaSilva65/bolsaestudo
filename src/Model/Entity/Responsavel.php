<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Responsavel Entity
 *
 * @property int $id
 * @property string|null $nm_responsavel
 * @property \Cake\I18n\FrozenDate|null $dt_nascimento
 * @property string $vl_cpf
 * @property \Cake\I18n\FrozenTime|null $created
 * @property string|null $vl_rg
 * @property string|null $nm_email
 * @property string|null $vl_titulo
 * @property string|null $vl_zona
 * @property string|null $vl_secao
 * @property string|null $ds_trabalho
 * @property string|null $ds_profissao
 * @property string|null $nm_rua
 * @property int|null $vl_numero
 * @property string|null $nm_bairro
 * @property string|null $nm_cidade
 * @property string|null $vl_cep_trab
 * @property string|null $cd_telefone
 * @property string|null $cd_cel
 * @property string|null $concessao_fam
 * @property string|null $concessao_aluno
 * @property string|null $concessao_escola
 *
 * @property \App\Model\Entity\Candidato[] $candidatos
 * @property \App\Model\Entity\Inscrico[] $inscricoes
 */
class Responsavel extends Entity
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
        'nm_responsavel' => true,
        'dt_nascimento' => true,
        'vl_cpf' => true,
        'created' => true,
        'modified' => true,
        'vl_rg_resp' => true,
        'nm_email' => true,
        'vl_titulo' => true,
        'vl_zona' => true,
        'vl_secao' => true,
        'ds_trabalho' => true,
        'ds_profissao' => true,
        'nm_rua_trab' => true,
        'vl_numero_trab' => true,
        'nm_bairro_trab' => true,
        'nm_cidade_trab' => true,
        'vl_cep_trab' => true,
        'cd_telefone' => true,
        'cd_cel' => true,
        'concessao_fam' => true,
        'concessao_aluno' => true,
        'concessao_escola' => true,
        'escola_id' => true,
        'candidatos' => true,
        'inscricoes' => true,
    ];
}

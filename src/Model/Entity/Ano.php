<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ano Entity
 *
 * @property int $id
 * @property string $nm_ano
 * @property bool $ic_ativo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $tipo_id
 *
 * @property \App\Model\Entity\Tipo $tipo
 * @property \App\Model\Entity\Candidato[] $candidatos
 * @property \App\Model\Entity\EscolasTipo[] $escolas_tipos
 */
class Ano extends Entity
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
        'nm_ano' => true,
        'ic_ativo' => true,
        'created' => true,
        'modified' => true,
        'tipo_id' => true,
        'tipo' => true,
        'candidatos' => true,
        'escolas_tipos' => true,
    ];
}

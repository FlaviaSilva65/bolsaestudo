<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EscolasTipo Entity
 *
 * @property int $id
 * @property int $escola_id
 * @property int $tipo_id
 * @property bool $ic_ativo
 *
 * @property \App\Model\Entity\Escola $escola
 * @property \App\Model\Entity\Tipo $tipo
 * @property \App\Model\Entity\Ano[] $anos
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class EscolasTipo extends Entity
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
        'escola_id' => true,
        'tipo_id' => true,
        'ic_ativo' => true,
        'escola' => true,
        'tipo' => true,
        'anos' => true,
        'created' => true,
        'modified' => true,
    ];
}

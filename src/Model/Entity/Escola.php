<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Escola Entity
 *
 * @property int $id
 * @property string $nm_escola
 * @property bool $ic_ativo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Candidato[] $candidatos
 * @property \App\Model\Entity\Tipo[] $tipos
 */
class Escola extends Entity
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
        'nm_escola' => true,
        'ic_ativo' => true,
        'created' => true,
        'modified' => true,
        'candidatos' => true,
        'tipos' => true,
    ];
}

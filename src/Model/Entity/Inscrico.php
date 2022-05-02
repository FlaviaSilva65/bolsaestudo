<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inscrico Entity
 *
 * @property int $id
 * @property int $evento_id
 * @property int $candidato_id
 * @property int $responsavel_id
 * @property int $pontos
 * @property int $ic_recurso
 * @property string|null $ds_motivo_recurso
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Evento $evento
 * @property \App\Model\Entity\Candidato $candidato
 * @property \App\Model\Entity\Responsavel $responsavel
 */
class Inscrico extends Entity
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
        'evento_id' => true,
        'candidato_id' => true,
        'responsavel_id' => true,
        'pontos' => true,
        'ic_recurso' => true,
        'ds_motivo_recurso' => true,
        'created' => true,
        'modified' => true,
        'evento' => true,
        'candidato' => true,
        'responsavel' => true,
    ];
}

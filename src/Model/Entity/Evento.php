<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evento Entity
 *
 * @property int $id
 * @property int $id_tp_eventos
 * @property \Cake\I18n\FrozenDate $ano_evento
 * @property \Cake\I18n\FrozenDate $dt_inicio
 * @property \Cake\I18n\FrozenDate $dt_fim
 * @property int $ic_ativo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Inscrico[] $inscricoes
 */
class Evento extends Entity
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
        'tp_eventos_id' => true,
        'ano_evento' => true,
        'dt_inicio' => true,
        'dt_fim' => true,
        'ic_ativo' => true,
        'created' => true,
        'modified' => true,
        'inscricoes' => true,
    ];
}

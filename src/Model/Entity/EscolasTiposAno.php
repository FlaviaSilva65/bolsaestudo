<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EscolasTiposAno Entity
 *
 * @property int $id
 * @property int $escolas_tipo_id
 * @property int $ano_id
 * @property bool $ic_ativo
 *
 * @property \App\Model\Entity\EscolasTipo $escolas_tipo
 * @property \App\Model\Entity\Ano $ano
 */
class EscolasTiposAno extends Entity
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
        'escolas_tipo_id' => true,
        'ano_id' => true,
        'ic_ativo' => true,
        'escolas_tipo' => true,
        'ano' => true,
    ];
}

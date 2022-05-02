<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tipos Model
 *
 * @property \App\Model\Table\AnosTable&\Cake\ORM\Association\HasMany $Anos
 * @property \App\Model\Table\CandidatosTable&\Cake\ORM\Association\HasMany $Candidatos
 * @property \App\Model\Table\EscolasTable&\Cake\ORM\Association\BelongsToMany $Escolas
 *
 * @method \App\Model\Entity\Tipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tipo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tipo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tipo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TiposTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tipos');
        $this->setDisplayField('nm_tipo');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Anos', [
            'foreignKey' => 'tipo_id',
        ]);
        $this->hasMany('Candidatos', [
            'foreignKey' => 'tipo_id',
        ]);
        // $this->belongsToMany('Escolas', [
        //     'foreignKey' => 'tipo_id',
        //     'targetForeignKey' => 'escola_id',
        //     'joinTable' => 'escolas_tipos',
        // ]);
        $this->hasMany('EscolasTipos', [
            'foreignKey' => 'tipo_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nm_tipo')
            ->maxLength('nm_tipo', 105)
            ->notEmptyString('nm_tipo');

        $validator
            ->boolean('ic_ativo')
            ->notEmptyString('ic_ativo');

        return $validator;
    }
}

<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Escolas Model
 *
 * @property \App\Model\Table\CandidatosTable&\Cake\ORM\Association\HasMany $Candidatos
 * @property \App\Model\Table\TiposTable&\Cake\ORM\Association\BelongsToMany $Tipos
 *
 * @method \App\Model\Entity\Escola get($primaryKey, $options = [])
 * @method \App\Model\Entity\Escola newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Escola[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Escola|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Escola saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Escola patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Escola[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Escola findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EscolasTable extends Table
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

        $this->setTable('escolas');
        $this->setDisplayField('nm_escola');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Candidatos', [
            'foreignKey' => 'escola_id',
        ]);
        $this->hasMany('EscolasTipos', [
            'foreignKey' => 'escola_id'
        ]);

        $this->belongsToMany('Tipos', [
            'foreignKey' => 'escola_id',
            'targetForeignKey' => 'tipo_id',
            'joinTable' => 'escolas_tipos',
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
            ->scalar('nm_escola')
            ->maxLength('nm_escola', 255)
            ->notEmptyString('nm_escola');

        $validator
            ->boolean('ic_ativo')
            ->notEmptyString('ic_ativo');

        return $validator;
    }
}

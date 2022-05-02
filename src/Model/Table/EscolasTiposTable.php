<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EscolasTipos Model
 *
 * @property \App\Model\Table\EscolasTable&\Cake\ORM\Association\BelongsTo $Escolas
 * @property \App\Model\Table\TiposTable&\Cake\ORM\Association\BelongsTo $Tipos
 * @property \App\Model\Table\AnosTable&\Cake\ORM\Association\BelongsToMany $Anos
 *
 * @method \App\Model\Entity\EscolasTipo get($primaryKey, $options = [])
 * @method \App\Model\Entity\EscolasTipo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EscolasTipo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EscolasTipo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EscolasTipo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EscolasTipo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EscolasTipo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EscolasTipo findOrCreate($search, callable $callback = null, $options = [])
 */
class EscolasTiposTable extends Table
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

        $this->setTable('escolas_tipos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Escolas', [
            'foreignKey' => 'escola_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tipos', [
            'foreignKey' => 'tipo_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('EscolasTiposAnos', [
            'foreignKey' => 'escolas_tipo_id'
        ]);
        $this->belongsToMany('Anos', [
            'foreignKey' => 'escolas_tipo_id',
            'targetForeignKey' => 'ano_id',
            'joinTable' => 'escolas_tipos_anos',
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
            ->boolean('ic_ativo')
            ->notEmptyString('ic_ativo');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['escola_id'], 'Escolas'));
        $rules->add($rules->existsIn(['tipo_id'], 'Tipos'));

        return $rules;
    }
}

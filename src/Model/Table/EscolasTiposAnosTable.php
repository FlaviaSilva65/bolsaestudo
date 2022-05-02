<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EscolasTiposAnos Model
 *
 * @property \App\Model\Table\EscolasTiposTable&\Cake\ORM\Association\BelongsTo $EscolasTipos
 * @property \App\Model\Table\AnosTable&\Cake\ORM\Association\BelongsTo $Anos
 *
 * @method \App\Model\Entity\EscolasTiposAno get($primaryKey, $options = [])
 * @method \App\Model\Entity\EscolasTiposAno newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EscolasTiposAno[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EscolasTiposAno|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EscolasTiposAno saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EscolasTiposAno patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EscolasTiposAno[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EscolasTiposAno findOrCreate($search, callable $callback = null, $options = [])
 */
class EscolasTiposAnosTable extends Table
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

        $this->setTable('escolas_tipos_anos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('EscolasTipos', [
            'foreignKey' => 'escolas_tipo_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Anos', [
            'foreignKey' => 'ano_id',
            'joinType' => 'INNER',
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
        $rules->add($rules->existsIn(['escolas_tipo_id'], 'EscolasTipos'));
        $rules->add($rules->existsIn(['ano_id'], 'Anos'));

        return $rules;
    }
}

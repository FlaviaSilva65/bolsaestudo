<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Anos Model
 *
 * @property \App\Model\Table\TiposTable&\Cake\ORM\Association\BelongsTo $Tipos
 * @property \App\Model\Table\CandidatosTable&\Cake\ORM\Association\HasMany $Candidatos
 * @property \App\Model\Table\EscolasTiposTable&\Cake\ORM\Association\BelongsToMany $EscolasTipos
 *
 * @method \App\Model\Entity\Ano get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ano newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ano[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ano|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ano saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ano patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ano[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ano findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnosTable extends Table
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

        $this->setTable('anos');
        $this->setDisplayField('nm_ano');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Tipos', [
            'foreignKey' => 'tipo_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Candidatos', [
            'foreignKey' => 'ano_id',
        ]);
        $this->belongsToMany('EscolasTipos', [
            'foreignKey' => 'ano_id',
            'targetForeignKey' => 'escolas_tipo_id',
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
            ->scalar('nm_ano')
            ->maxLength('nm_ano', 105)
            ->notEmptyString('nm_ano');

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
        $rules->add($rules->existsIn(['tipo_id'], 'Tipos'));

        return $rules;
    }
}

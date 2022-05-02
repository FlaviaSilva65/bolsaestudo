<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TpEventos Model
 *
 * @method \App\Model\Entity\TpEvento get($primaryKey, $options = [])
 * @method \App\Model\Entity\TpEvento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TpEvento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TpEvento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TpEvento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TpEvento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TpEvento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TpEvento findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TpEventosTable extends Table
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

        $this->setTable('tp_eventos');
        $this->setDisplayField('nm_tp_evento');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Eventos');
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nm_tp_evento')
            ->maxLength('nm_tp_evento', 50)
            ->requirePresence('nm_tp_evento', 'create')
            ->notEmptyString('nm_tp_evento');

        return $validator;
    }
}

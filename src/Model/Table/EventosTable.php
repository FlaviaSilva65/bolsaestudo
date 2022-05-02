<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Eventos Model
 *
 * @property \App\Model\Table\InscricoesTable&\Cake\ORM\Association\HasMany $Inscricoes
 *
 * @method \App\Model\Entity\Evento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Evento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Evento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Evento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Evento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Evento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Evento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Evento findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventosTable extends Table
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

        $this->setTable('eventos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Inscricoes', [
            'foreignKey' => 'evento_id',
        ]);

        $this->belongsTo('TpEventos', [
            'foreignKey' => 'tp_eventos_id',
            //            'joinType' => 'INNER'
        ]);

        // $this->hasMany('TpEventos');
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
            ->integer('tp_eventos_id')
            ->requirePresence('tp_eventos_id', 'create')
            ->notEmptyString('tp_eventos_id');

        $validator
            ->date('ano_evento')
            ->requirePresence('ano_evento', 'create')
            ->notEmptyString('ano_evento');

        $validator
            ->date('dt_inicio')
            ->requirePresence('dt_inicio', 'create')
            ->notEmptyDate('dt_inicio');

        $validator
            ->date('dt_fim')
            ->requirePresence('dt_fim', 'create')
            ->notEmptyDate('dt_fim');

        $validator
            ->integer('ic_ativo')
            ->notEmptyString('ic_ativo');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['tp_eventos_id'], 'TpEventos'));

        return $rules;
    }
}

<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inscricoes Model
 *
 * @property \App\Model\Table\EventosTable&\Cake\ORM\Association\BelongsTo $Eventos
 * @property \App\Model\Table\CandidatosTable&\Cake\ORM\Association\BelongsTo $Candidatos
 * @property \App\Model\Table\ResponsavelsTable&\Cake\ORM\Association\BelongsTo $Responsavels
 *
 * @method \App\Model\Entity\Inscrico get($primaryKey, $options = [])
 * @method \App\Model\Entity\Inscrico newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Inscrico[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Inscrico|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inscrico saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Inscrico patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Inscrico[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Inscrico findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InscricoesTable extends Table
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

        $this->setTable('inscricoes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Eventos', [
            'foreignKey' => 'evento_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Candidatos', [
            'foreignKey' => 'candidato_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Responsavels', [
            'foreignKey' => 'responsavel_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->notEmptyString('ic_recurso');

        $validator
            ->scalar('ds_motivo_recurso')
            ->maxLength('ds_motivo_recurso', 255)
            ->allowEmptyString('ds_motivo_recurso');

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
        $rules->add($rules->existsIn(['evento_id'], 'Eventos'));
        $rules->add($rules->existsIn(['candidato_id'], 'Candidatos'));
        $rules->add($rules->existsIn(['responsavel_id'], 'Responsavels'));

        return $rules;
    }
}

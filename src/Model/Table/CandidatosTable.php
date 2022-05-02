<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidatos Model
 *
 * @property \App\Model\Table\ResponsavelsTable&\Cake\ORM\Association\BelongsTo $Responsavels
 * @property \App\Model\Table\EscolasTable&\Cake\ORM\Association\BelongsTo $Escolas
 * @property \App\Model\Table\TiposTable&\Cake\ORM\Association\BelongsTo $Tipos
 * @property \App\Model\Table\AnosTable&\Cake\ORM\Association\BelongsTo $Anos
 * @property \App\Model\Table\InscricoesTable&\Cake\ORM\Association\HasMany $Inscricoes
 *
 * @method \App\Model\Entity\Candidato get($primaryKey, $options = [])
 * @method \App\Model\Entity\Candidato newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Candidato[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Candidato|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidato saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Candidato patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Candidato[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Candidato findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CandidatosTable extends Table
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

        $this->setTable('candidatos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Responsavels', [
            'foreignKey' => 'responsavel_id',
            // 'joinType' => 'INNER',
        ]);
        $this->belongsTo('Escolas', [
            'foreignKey' => 'escola_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Tipos', [
            'foreignKey' => 'tipo_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Anos', [
            'foreignKey' => 'ano_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Inscricoes', [
            'foreignKey' => 'candidato_id',
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
        $ns = 'Campo necessário.';
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nm_candidato')
            ->maxLength('nm_candidato', 100)
            ->notEmptyString('nm_candidato', $ns)
            ->add('nm_candidato', [
                'minLength' => [
                    'rule' => ['minLength', 8],
                    'message' => 'Nome e Sobrenome.'
                ]

            ]);

        $validator
            ->requirePresence('escola_id', 'create')
            ->notEmptyString('escola_id', 'Seleção obrigatória');

        $validator
            ->requirePresence('tipo_id', 'create')
            ->notEmptyString('tipo_id', 'Seleção obrigatória');

        $validator
            ->requirePresence('ano_id', 'create')
            ->notEmptyString('ano_id', 'Seleção obrigatória');

        $validator
            ->allowEmptyString('ic_deletado');

        $validator
            ->requirePresence('ic_ano_anterior', 'create')
            ->notEmptyString('ic_ano_anterior', 'Seleção obrigatória');
        // ->notEmptyString('ic_ano_anterior')
        // ->notEmptyString('ic_ano_anterior', $ns);

        $validator
            ->nonNegativeInteger('ic_recebido')
            ->notEmptyString('ic_recebido');

        $validator
            ->integer('ic_aprovado')
            ->allowEmptyString('ic_aprovado');

        $validator
            // ->notEmptyString('vl_ctnumero')
            ->maxLength('vl_ctnumero', 7)
            ->notEmptyString('vl_ctnumero', $ns)
            ->add('vl_ctnumero', [
                'minLength' => [
                    'rule' => ['minLength', 7],
                    'message' => 'Deve ter 7 digitos, se for menor completar com 0 no ínicio.'
                ]
            ]);

        $validator
            ->scalar('vl_ctlivro')
            ->maxLength('vl_ctlivro', 5)
            ->notEmptyString('vl_ctlivro', $ns)
            // ->allowEmptyString('vl_ctlivro')
            ->add('vl_ctlivro', [
                'minLength' => [
                    'rule' => ['minLength', 3],
                    'message' => 'Coloque 3 dígitos, caso contrário completar com 0 no ínicio.'
                ]
            ]);

        $validator
            ->scalar('vl_ctfolha')
            ->maxLength('vl_ctfolha', 5)
            // ->allowEmptyString('vl_ctfolha');
            ->notEmptyString('vl_ctfolha', $ns)
            ->add('vl_ctfolha', [
                'minLength' => [
                    'rule' => ['minLength', 3],
                    'message' => 'Deve ter 3 dígitos, se for menor completar com 0 no ínicio.'
                ]
            ]);

        $validator
            ->date('dt_nascimento')
            ->minLength('dt_nascimento', 10)
            ->notEmptyDate('dt_nascimento', $ns)
            ->add('dt_nascimento', [
                'minLength' => [
                    'rule' => ['minLength', 10],
                    'last' => true,
                    'message' => 'Deve ser preenchida a data.'
                ]
            ]);
        // ->notEmptyDate('dt_nascimento', $ns);


        $validator
            ->add('vl_rg', [
                'minLength' => [
                    'rule' => ['minLength', 12],
                    'last' => true,
                    'message' => 'Rg incompleto'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 12],
                ]
            ])
            ->allowEmptyString('vl_rg');

        $validator
            ->scalar('nm_mae')
            ->maxLength('nm_mae', 100)
            ->notEmptyString('nm_mae', $ns);

        $validator
            ->scalar('nm_pai')
            ->maxLength('nm_pai', 100)
            ->allowEmptyString('nm_pai');

        $validator
            ->scalar('nm_rua')
            ->maxLength('nm_rua', 50)
            ->notEmptyString('nm_rua', $ns);

        $validator
            ->scalar('vl_numero')
            ->maxLength('vl_numero', 7)
            ->allowEmptyString('vl_numero');

        $validator
            ->scalar('nm_bairro')
            ->maxLength('nm_bairro', 30)
            ->notEmptyString('nm_bairro', $ns);

        $validator
            ->scalar('nm_cidade')
            ->maxLength('nm_cidade', 30)
            ->notEmptyString('nm_cidade', $ns);

        $validator
            ->scalar('vl_cep')
            ->maxLength('vl_cep', 9)
            ->notEmptyString('vl_cep', $ns);

        $validator
            ->scalar('vl_tel')
            ->maxLength('vl_tel', 15)
            ->notEmptyString('vl_tel', $ns);

        // $validator
        //     ->scalar('periodo')
        //     ->maxLength('periodo', 30)
        //     ->notEmptyString('periodo');

        $validator
            ->scalar('vl_cel')
            ->maxLength('vl_cel', 15)
            ->allowEmptyString('vl_cel');

        $validator
            ->nonNegativeInteger('ds_moradia', 'Seleção obrigatória')
            ->notEmptyString('ds_moradia');

        $validator
            ->nonNegativeInteger('ds_dependentes', 'Seleção obrigatória')
            ->notEmptyString('ds_dependentes');

        $validator
            ->nonNegativeInteger('ds_rendafamiliar', 'Seleção obrigatória')
            ->notEmptyString('ds_rendafamiliar');

        $validator
            ->nonNegativeInteger('ds_transporte', 'Seleção obrigatória')
            ->notEmptyString('ds_transporte');

        $validator
            ->scalar('ds_info_compl')
            ->maxLength('ds_info_compl', 255)
            ->allowEmptyString('ds_info_compl');

        $validator
            ->scalar('ds_recebeobs')
            ->maxLength('ds_recebeobs', 255)
            ->allowEmptyString('ds_recebeobs');

        $validator
            ->requirePresence('ic_deficiente', 'create')
            ->notEmptyString('ic_deficiente', 'Seleção obrigatória');

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
        $rules->add($rules->existsIn(['responsavel_id'], 'Responsavels'));
        $rules->add($rules->existsIn(['escola_id'], 'Escolas'));
        $rules->add($rules->existsIn(['tipo_id'], 'Tipos'));
        $rules->add($rules->existsIn(['ano_id'], 'Anos'));

        return $rules;
    }
}

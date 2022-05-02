<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\Rule\IsUnique;

/**
 * Responsavels Model
 *
 * @property \App\Model\Table\CandidatosTable&\Cake\ORM\Association\HasMany $Candidatos
 * @property \App\Model\Table\InscricoesTable&\Cake\ORM\Association\HasMany $Inscricoes
 *
 * @method \App\Model\Entity\Responsavel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Responsavel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Responsavel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Responsavel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Responsavel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Responsavel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Responsavel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Responsavel findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResponsavelsTable extends Table
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

        $this->setTable('responsavels');
        $this->setDisplayField('nm_responsavel');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Candidatos', [
            'foreignKey' => 'responsavel_id',
        ]);
        $this->hasMany('Inscricoes', [
            'foreignKey' => 'responsavel_id',
        ]);
        $this->belongsTo('Escolas', [
            'foreignKey' => 'escola_id',
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
        $ns = 'Campo necessário.';
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nm_responsavel')
            ->maxLength('nm_responsavel', 255)
            ->notEmptyString('nm_responsavel', $ns)
            ->add('nm_responsavel', [
                'minLength' => [
                    'rule' => ['minLength', 8],
                    'message' => 'Nome e Sobrenome.'
                ]

            ]);

        $validator
            ->date('dt_nascimento')
            ->allowEmptyDate('dt_nascimento');

        $validator
            ->scalar('vl_cpf')
            ->maxLength('vl_cpf', 14)
            ->notEmptyString('vl_cpf', $ns)
            ->add('vl_cpf', [
                'minLength' => [
                    'rule' => ['minLength', 14],
                    'message' => 'Digite apenas números.'
                ],
                'unique' => [
                    'rule' => 'validateUnique',
                    'message' => 'Este CPF já está cadastrado.',
                    'provider' => 'table'
                ]
            ]);

        $validator
            ->add('vl_rg_resp', [
                'minLength' => [
                    'rule' => ['minLength', 12],
                    'last' => true,
                    'message' => 'Rg incompleto'
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 12],
                ]
            ])
            ->allowEmptyString('vl_rg_resp');

        $validator
            ->scalar('nm_email')
            ->maxLength('nm_email', 150)
            ->allowEmptyString('nm_email');

        $validator
            ->scalar('vl_titulo')
            ->maxLength('vl_titulo', 12)
            ->notEmptyString('vl_titulo', $ns)
            ->add('vl_titulo', [
                'minLength' => [
                    'rule' => ['minLength', 12],
                    'message' => 'Digite a inscrição. Mín.12 caracteres.'
                ]
            ]);

        $validator
            ->scalar('vl_zona')
            ->maxLength('vl_zona', 10)
            ->notEmptyString('vl_zona', $ns)
            ->add('vl_zona', [
                'minLength' => [
                    'rule' => ['minLength', 3],
                    'message' => 'Digite apenas a zona.'
                ]
            ]);

        $validator
            ->scalar('vl_secao')
            ->maxLength('vl_secao', 4)
            ->notEmptyString('vl_secao', $ns)
            ->add('vl_secao', [
                'minLength' => [
                    'rule' => ['minLength', 2],
                    'message' => 'Digite apenas a seção.'
                ]

            ]);

        $validator
            ->scalar('ds_trabalho')
            ->maxLength('ds_trabalho', 100)
            ->allowEmptyString('ds_trabalho');

        $validator

            ->maxLength('ds_profissao', 100)
            ->notEmptyString('ds_profissao', 'Seleção obrigatória');

        $validator
            ->scalar('nm_rua_trab')
            ->maxLength('nm_rua_trab', 255)
            ->allowEmptyString('nm_rua_trab');

        $validator
            ->nonNegativeInteger('vl_numero_trab')
            ->allowEmptyString('vl_numero_trab');

        $validator
            ->scalar('nm_bairro_trab')
            ->maxLength('nm_bairro_trab', 100)
            ->allowEmptyString('nm_bairro_trab');

        $validator
            ->scalar('nm_cidade_trab')
            ->maxLength('nm_cidade_trab', 100)
            ->allowEmptyString('nm_cidade_trab');

        $validator
            ->scalar('vl_cep_trab')
            ->maxLength('vl_cep_trab', 9)
            ->allowEmptyString('vl_cep_trab');

        $validator
            ->scalar('cd_telefone')
            ->maxLength('cd_telefone', 50)
            ->allowEmptyString('cd_telefone');

        $validator
            ->scalar('cd_cel')
            ->maxLength('cd_cel', 15)
            ->allowEmptyString('cd_cel');

        $validator
            ->nonNegativeInteger('concessao_fam')
            ->notEmptyString('concessao_fam', 'Seleção obrigatória');

        $validator
            ->scalar('concessao_aluno')
            ->maxLength('concessao_aluno', 100)
            ->allowEmptyString('concessao_aluno');

        // $validator
        //     ->scalar('concessao_escola')
        //     ->maxLength('concessao_escola', 100)
        //     ->allowEmptyString('concessao_escola');

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        // $rules->addCreate($rules->isUnique(['vl_cpf'], 'Este CPF já está cadastrado.'));

        $rules->add($rules->isUnique(['vl_cpf']));

        return $rules;
    }
}

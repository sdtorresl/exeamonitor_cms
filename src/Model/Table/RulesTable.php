<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rules Model
 *
 * @property \App\Model\Table\PlaybooksTable&\Cake\ORM\Association\BelongsTo $Playbooks
 *
 * @method \App\Model\Entity\Rule newEmptyEntity()
 * @method \App\Model\Entity\Rule newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Rule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rule get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rule findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Rule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rule[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rule[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rule[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rule[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rule[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RulesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('rules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Playbooks', [
            'foreignKey' => 'playbook_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('tag')
            ->maxLength('tag', 255)
            ->requirePresence('tag', 'create')
            ->notEmptyString('tag');

        $validator
            ->scalar('logic')
            ->maxLength('logic', 255)
            ->requirePresence('logic', 'create')
            ->notEmptyString('logic');

        $validator
            ->nonNegativeInteger('playbook_id')
            ->notEmptyString('playbook_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('playbook_id', 'Playbooks'), ['errorField' => 'playbook_id']);

        return $rules;
    }
}

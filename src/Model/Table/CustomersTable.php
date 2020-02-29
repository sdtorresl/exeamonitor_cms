<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @property \App\Model\Table\PointsOfSaleTable&\Cake\ORM\Association\HasMany $PointsOfSale
 *
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('PointsOfSale', [
            'foreignKey' => 'customer_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('contact_person')
            ->maxLength('contact_person', 255)
            ->allowEmptyString('contact_person');

        $validator
            ->scalar('contact_phone')
            ->maxLength('contact_phone', 15)
            ->allowEmptyString('contact_phone');

        $validator
            ->maxLength('logo', 255)
            ->allowEmptyString('logo');

        $validator
            ->maxLength('logo_dir', 255)
            ->allowEmptyString('logo_dir');

        $validator
            ->maxLength('logo_type', 255)
            ->allowEmptyString('logo_type');

        $validator
            ->scalar('background')
            ->maxLength('background', 255)
            ->allowEmptyString('background');

        $validator
            ->scalar('background_dir')
            ->maxLength('background_dir', 255)
            ->allowEmptyString('background_dir');

        $validator
            ->scalar('background_type')
            ->maxLength('background_type', 255)
            ->allowEmptyString('background_type');

        $validator
            ->scalar('stream_name')
            ->maxLength('stream_name', 255)
            ->requirePresence('stream_name', 'create')
            ->notEmptyString('stream_name');

        $validator
            ->scalar('stream_url')
            ->maxLength('stream_url', 255)
            ->requirePresence('stream_url', 'create')
            ->notEmptyString('stream_url');

        $validator
            ->scalar('backup_url')
            ->maxLength('backup_url', 255)
            ->allowEmptyString('backup_url');

        $validator
            ->scalar('primary_color')
            ->maxLength('primary_color', 6)
            ->minLength('primary_color', 6)
            ->allowEmptyString('primary_color');

        $validator
            ->scalar('secondary_color')
            ->maxLength('secondary_color', 6)
            ->minLength('secondary_color', 6)
            ->allowEmptyString('secondary_color');

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
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}

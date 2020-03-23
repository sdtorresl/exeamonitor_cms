<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Checks Model
 *
 * @property \App\Model\Table\PointsOfSaleTable&\Cake\ORM\Association\BelongsTo $PointsOfSale
 *
 * @method \App\Model\Entity\Check get($primaryKey, $options = [])
 * @method \App\Model\Entity\Check newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Check[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Check|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Check saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Check patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Check[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Check findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChecksTable extends Table
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

        $this->setTable('checks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PointsOfSale', [
            'foreignKey' => 'pos_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('state')
            ->maxLength('state', 20)
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        $validator
            ->integer('volume')
            ->allowEmptyString('volume');

        $validator
            ->scalar('current_song')
            ->maxLength('current_song', 100)
            ->allowEmptyString('current_song');

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
        $rules->add($rules->existsIn(['pos_id'], 'PointsOfSale'));

        return $rules;
    }
}

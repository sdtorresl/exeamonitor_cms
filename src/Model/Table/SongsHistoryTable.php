<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SongsHistory Model
 *
 * @property \App\Model\Table\PointsOfSaleTable&\Cake\ORM\Association\BelongsTo $PointsOfSale
 *
 * @method \App\Model\Entity\SongsHistory newEmptyEntity()
 * @method \App\Model\Entity\SongsHistory newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SongsHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SongsHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\SongsHistory findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SongsHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SongsHistory[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SongsHistory|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SongsHistory saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SongsHistory[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SongsHistory[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SongsHistory[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SongsHistory[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SongsHistoryTable extends Table
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

        $this->setTable('songs_history');
        $this->setDisplayField('title');
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('author')
            ->maxLength('author', 255)
            ->requirePresence('author', 'create')
            ->notEmptyString('author');

        $validator
            ->integer('song_id')
            ->requirePresence('song_id', 'create')
            ->notEmptyString('song_id');

        $validator
            ->integer('customer_id')
            ->requirePresence('customer_id', 'create')
            ->notEmptyString('customer_id');

        $validator
            ->integer('pos_id')
            ->notEmptyString('pos_id');

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
        $rules->add($rules->existsIn('pos_id', 'PointsOfSale'), ['errorField' => 'pos_id']);

        return $rules;
    }
}

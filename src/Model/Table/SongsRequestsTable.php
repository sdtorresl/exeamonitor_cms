<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SongsRequests Model
 *
 * @property \App\Model\Table\PointsOfSaleTable&\Cake\ORM\Association\BelongsTo $PointsOfSale
 *
 * @method \App\Model\Entity\SongsRequest newEmptyEntity()
 * @method \App\Model\Entity\SongsRequest newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SongsRequest[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SongsRequest get($primaryKey, $options = [])
 * @method \App\Model\Entity\SongsRequest findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SongsRequest patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SongsRequest[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SongsRequest|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SongsRequest saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SongsRequest[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SongsRequest[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SongsRequest[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SongsRequest[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SongsRequestsTable extends Table
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

        $this->setTable('songs_requests');
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
            ->integer('pos_id')
            ->notEmptyString('pos_id');

        $validator
            ->boolean('played')
            ->notEmptyString('played');

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

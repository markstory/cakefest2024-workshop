<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Options Model
 *
 * @method \App\Model\Entity\Option newEmptyEntity()
 * @method \App\Model\Entity\Option newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Option> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Option get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Option findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Option patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Option> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Option|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Option saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Option>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Option>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Option>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Option> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Option>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Option>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Option>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Option> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OptionsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('options');
        $this->setDisplayField('key');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('key')
            ->requirePresence('key', 'create')
            ->notEmptyString('key')
            ->add('key', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('type')
            ->allowEmptyString('type');

        $validator
            ->scalar('value')
            ->allowEmptyString('value');

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
        $rules->add($rules->isUnique(['key']), ['errorField' => 'key']);

        return $rules;
    }
}

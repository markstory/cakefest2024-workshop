<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationOptions Model
 *
 * @property \App\Model\Table\OrganizationsTable&\Cake\ORM\Association\BelongsTo $Organizations
 *
 * @method \App\Model\Entity\OrganizationOption newEmptyEntity()
 * @method \App\Model\Entity\OrganizationOption newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrganizationOption> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOption get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrganizationOption findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrganizationOption patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrganizationOption> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationOption|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrganizationOption saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationOption>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationOption> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationOption>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationOption>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationOption> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationOptionsTable extends Table
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

        $this->setTable('organization_options');
        $this->setDisplayField('key');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
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
            ->integer('organization_id')
            ->notEmptyString('organization_id');

        $validator
            ->scalar('key')
            ->requirePresence('key', 'create')
            ->notEmptyString('key');

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
        $rules->add($rules->isUnique(['organization_id', 'key']), ['errorField' => 'organization_id']);
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'), ['errorField' => 'organization_id']);

        return $rules;
    }
}

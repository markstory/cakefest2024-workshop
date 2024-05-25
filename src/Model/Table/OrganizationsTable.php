<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Organizations Model
 *
 * @property \App\Model\Table\OrganizationInvitesTable&\Cake\ORM\Association\HasMany $OrganizationInvites
 * @property \App\Model\Table\OrganizationMembersTable&\Cake\ORM\Association\HasMany $OrganizationMembers
 * @property \App\Model\Table\OrganziationOptionsTable&\Cake\ORM\Association\HasMany $OrganziationOptions
 * @property \App\Model\Table\ProjectsTable&\Cake\ORM\Association\HasMany $Projects
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\HasMany $Teams
 *
 * @method \App\Model\Entity\Organization newEmptyEntity()
 * @method \App\Model\Entity\Organization newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Organization> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Organization get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Organization findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Organization patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Organization> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Organization|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Organization saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Organization>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organization>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organization>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organization> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organization>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organization>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Organization>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Organization> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationsTable extends Table
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

        $this->setTable('organizations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('Sluggable', ['label' => ['name']]);

        $this->hasMany('OrganizationInvites', [
            'foreignKey' => 'organization_id',
        ]);
        $this->hasMany('OrganizationMembers', [
            'foreignKey' => 'organization_id',
        ]);
        $this->hasMany('OrganizationOptions', [
            'foreignKey' => 'organization_id',
        ]);
        $this->hasMany('Projects', [
            'foreignKey' => 'organization_id',
        ]);
        $this->hasMany('Teams', [
            'foreignKey' => 'organization_id',
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
            ->scalar('slug')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->allowEmptyString('name');

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
        $rules->add($rules->isUnique(['slug']), ['errorField' => 'slug']);

        return $rules;
    }
}

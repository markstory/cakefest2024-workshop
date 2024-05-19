<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TeamMembers Model
 *
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\BelongsTo $Teams
 * @property \App\Model\Table\OrganizationMembersTable&\Cake\ORM\Association\BelongsTo $OrganizationMembers
 *
 * @method \App\Model\Entity\TeamMember newEmptyEntity()
 * @method \App\Model\Entity\TeamMember newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\TeamMember> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TeamMember get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\TeamMember findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\TeamMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\TeamMember> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TeamMember|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\TeamMember saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\TeamMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TeamMember>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TeamMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TeamMember> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TeamMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TeamMember>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\TeamMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\TeamMember> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TeamMembersTable extends Table
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

        $this->setTable('team_members');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('OrganizationMembers', [
            'foreignKey' => 'organization_member_id',
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
            ->integer('team_id')
            ->notEmptyString('team_id');

        $validator
            ->integer('organization_member_id')
            ->notEmptyString('organization_member_id');

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
        $rules->add($rules->existsIn(['team_id'], 'Teams'), ['errorField' => 'team_id']);
        $rules->add($rules->existsIn(['organization_member_id'], 'OrganizationMembers'), ['errorField' => 'organization_member_id']);

        return $rules;
    }
}

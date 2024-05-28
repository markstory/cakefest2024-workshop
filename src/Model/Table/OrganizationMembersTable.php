<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Enum\MemberRoleEnum;
use Cake\Database\Type\EnumType;
use Cake\Datasource\EntityInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationMembers Model
 *
 * @property \App\Model\Table\OrganizationsTable&\Cake\ORM\Association\BelongsTo $Organizations
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\OrganizationInvitesTable&\Cake\ORM\Association\HasMany $OrganizationInvites
 * @property \App\Model\Table\TeamMembersTable&\Cake\ORM\Association\HasMany $TeamMembers
 *
 * @method \App\Model\Entity\OrganizationMember newEmptyEntity()
 * @method \App\Model\Entity\OrganizationMember newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrganizationMember> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationMember get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrganizationMember findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrganizationMember patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrganizationMember> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationMember|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrganizationMember saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationMember>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationMember> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationMember>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationMember>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationMember> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationMembersTable extends Table
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

        $this->setTable('organization_members');
        $this->setDisplayField('role');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('OrganizationInvites', [
            'foreignKey' => 'organization_member_id',
        ]);
        $this->hasMany('TeamMembers', [
            'foreignKey' => 'organization_member_id',
        ]);

        $this->getSchema()->setColumnType('role', EnumType::from(MemberRoleEnum::class));
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->enum('role', MemberRoleEnum::class);

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
        $rules->add($rules->existsIn(['organization_id'], 'Organizations'), ['errorField' => 'organization_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }

    public function beforeSave(EventInterface $event, OrganizationInvite $invite, array $options): bool
    {
        if ($invite->isDirty('user_id')) {
            $invite->refreshVerifyToken();
        }
        return true;
    }
}

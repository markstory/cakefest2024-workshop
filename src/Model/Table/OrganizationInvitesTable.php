<?php
declare(strict_types=1);

namespace App\Model\Table;

use App\Model\Entity\OrganizationInvite;
use App\Model\Enum\MemberRoleEnum;
use ArrayObject;
use Cake\Database\Type\EnumType;
use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrganizationInvites Model
 *
 * @property \App\Model\Table\OrganizationsTable&\Cake\ORM\Association\BelongsTo $Organizations
 * @property \App\Model\Table\OrganizationMembersTable&\Cake\ORM\Association\BelongsTo $OrganizationMembers
 *
 * @method \App\Model\Entity\OrganizationInvite newEmptyEntity()
 * @method \App\Model\Entity\OrganizationInvite newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrganizationInvite> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationInvite get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrganizationInvite findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrganizationInvite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrganizationInvite> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrganizationInvite|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrganizationInvite saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationInvite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationInvite>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationInvite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationInvite> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationInvite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationInvite>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrganizationInvite>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrganizationInvite> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrganizationInvitesTable extends Table
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

        $this->setTable('organization_invites');
        $this->setDisplayField('email');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Organizations', [
            'foreignKey' => 'organization_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('OrganizationMembers', [
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        // TODO use an enum instead.
        $validator
            ->enum('role', MemberRoleEnum::class);

        $validator
            ->scalar('teams')
            ->allowEmptyString('teams');

        $validator
            ->integer('organization_member_id')
            ->allowEmptyString('organization_member_id');

        $validator
            ->scalar('verify_token')
            ->requirePresence('verify_token', 'create')
            ->notEmptyString('verify_token');

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
        $rules->add($rules->existsIn(['organization_member_id'], 'OrganizationMembers'), ['errorField' => 'organization_member_id']);

        return $rules;
    }

    public function beforeSave(EventInterface $event, OrganizationInvite $invite, ArrayObject $options): bool
    {
        if ($invite->isDirty('user_id')) {
            $invite->refreshVerifyToken();
        }

        return true;
    }
}

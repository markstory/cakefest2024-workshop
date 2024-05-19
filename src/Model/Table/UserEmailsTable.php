<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserEmails Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\UserEmail newEmptyEntity()
 * @method \App\Model\Entity\UserEmail newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\UserEmail> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserEmail get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\UserEmail findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\UserEmail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\UserEmail> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserEmail|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\UserEmail saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\UserEmail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserEmail>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserEmail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserEmail> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserEmail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserEmail>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\UserEmail>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\UserEmail> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserEmailsTable extends Table
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

        $this->setTable('user_emails');
        $this->setDisplayField('email');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->boolean('email_verified')
            ->notEmptyString('email_verified');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}

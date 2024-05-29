<?php
declare(strict_types=1);

use App\Model\Enum\MemberRoleEnum;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Utility\Inflector;
use Faker\Factory;
use Migrations\AbstractSeed;

/**
 * LocalDevData seed.
 */
class LocalDevDataSeed extends AbstractSeed
{
    use LocatorAwareTrait;

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        $hasher = new DefaultPasswordHasher();
        $data = [
            [
                'email' => 'owner@example.com',
                'password' => $hasher->hash('cakefest'),
                'name' => $faker->name(),
                'email_verified' => 1,
            ],
            [
                'email' => 'member@example.com',
                'password' => $hasher->hash('cakefest'),
                'name' => $faker->name(),
                'email_verified' => 1,
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();

        $users = $this->fetchTable('Users');
        $owner = $users->findByEmail('owner@example.com')->firstOrFail();
        $member = $users->findByEmail('member@example.com')->firstOrFail();

        $organizations = $this->fetchTable('Organizations');

        // An org we don't have access to.
        $organizations->newEntity([
            'name' => $faker->name(),
        ]);

        // An org with all the relations. Could be factored out to create multiple orgs with data.
        $org = $organizations->newEntity([
            'name' => $faker->name(),
        ]);
        $org->organization_members = [
            $organizations->OrganizationMembers->newEntity([
                'user_id' => $owner->id,
                'role' => MemberRoleEnum::Owner,
            ]),
            $organizations->OrganizationMembers->newEntity([
                'user_id' => $member->id,
                'role' => MemberRoleEnum::Member,
            ]),
        ];
        $org = $organizations->saveOrFail($org, ['associated' => ['OrganizationMembers']]);

        // Teams
        $createdTeams = [];
        $teams = $this->fetchTable('Teams');
        for ($i = 0; $i <= 3; $i++) {
            $team = $teams->newEntity([
                'organization_id' => $org->id,
                'name' => $faker->word(),
            ]);
            $index = rand(0, count($org->organization_members) - 1);
            $team->team_members = [
                $teams->TeamMembers->newEntity([
                    'organization_member_id' => $org->organization_members[$index]->id,
                ]),
            ];
            $team = $teams->saveOrFail($team, ['associated' => ['TeamMembers']]);
            $createdTeams[] = $team;
        }

        // Projects
        $projects = $this->fetchTable('Projects');
        for ($i = 0; $i <= 3; $i++) {
            $project = $projects->newEntity([
                'organization_id' => $org->id,
                'name' => $faker->word(),
            ]);
            $index = rand(0, count($createdTeams) - 1);
            $project->teams = [
                $createdTeams[$index],
            ];
            $projects->saveOrFail($project, ['associated' => ['Teams']]);
        }
    }
}

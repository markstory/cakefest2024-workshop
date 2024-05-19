<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeamMembersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TeamMembersTable Test Case
 */
class TeamMembersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamMembersTable
     */
    protected $TeamMembers;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.TeamMembers',
        'app.Teams',
        'app.OrganizationMembers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('TeamMembers') ? [] : ['className' => TeamMembersTable::class];
        $this->TeamMembers = $this->getTableLocator()->get('TeamMembers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->TeamMembers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TeamMembersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\TeamMembersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

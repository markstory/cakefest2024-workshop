<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrganizationInvitesFixture
 */
class OrganizationInvitesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'organization_id' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'role' => 'Lorem ipsum dolor sit amet',
                'teams' => 'Lorem ipsum dolor sit amet',
                'organization_member_id' => 1,
                'created' => '2024-05-19 03:42:23',
                'modified' => '2024-05-19 03:42:23',
            ],
        ];
        parent::init();
    }
}

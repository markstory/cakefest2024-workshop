<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrganizationMembersFixture
 */
class OrganizationMembersFixture extends TestFixture
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
                'user_id' => 1,
                'role' => 'Lorem ipsum dolor sit amet',
                'created' => '2024-05-19 03:42:17',
                'modified' => '2024-05-19 03:42:17',
            ],
        ];
        parent::init();
    }
}

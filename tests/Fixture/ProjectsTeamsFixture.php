<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProjectsTeamsFixture
 */
class ProjectsTeamsFixture extends TestFixture
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
                'project_id' => 1,
                'team_id' => 1,
                'created' => '2024-05-19 03:42:57',
                'modified' => '2024-05-19 03:42:57',
            ],
        ];
        parent::init();
    }
}

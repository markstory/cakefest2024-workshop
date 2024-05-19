<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UserEmailsFixture
 */
class UserEmailsFixture extends TestFixture
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
                'user_id' => 1,
                'email' => 'Lorem ipsum dolor sit amet',
                'email_verified' => 1,
                'created' => '2024-05-19 03:39:29',
                'updated' => '2024-05-19 03:39:29',
            ],
        ];
        parent::init();
    }
}

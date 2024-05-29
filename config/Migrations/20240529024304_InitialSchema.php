<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class InitialSchema extends AbstractMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     * @return void
     */
    public function up(): void
    {
        $this->table('options')
            ->addColumn('key', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('type', 'string', [
                'default' => 'string',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'key',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('organization_invites')
            ->addColumn('organization_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('role', 'string', [
                'default' => 'member',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('verify_token', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('teams', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('organization_member_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('organization_members')
            ->addColumn('organization_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('role', 'string', [
                'default' => 'member',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'organization_id',
                    'user_id',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('organization_options')
            ->addColumn('organization_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('key', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('type', 'string', [
                'default' => 'string',
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('value', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'organization_id',
                    'key',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('organizations')
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('updated', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'slug',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('projects')
            ->addColumn('organization_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'organization_id',
                    'slug',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('projects_teams')
            ->addColumn('project_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('team_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'project_id',
                    'team_id',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('team_members')
            ->addColumn('team_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('organization_member_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

        $this->table('teams')
            ->addColumn('organization_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('slug', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'organization_id',
                    'slug',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('user_emails')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('email_verified', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('updated', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'email',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('users')
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('email_verified', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('last_active', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('updated', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'email',
                ],
                [
                    'unique' => true,
                ]
            )
            ->create();

        $this->table('organization_invites')
            ->addForeignKey(
                'organization_id',
                'organizations',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'organization_id_0_fk'
                ]
            )
            ->addForeignKey(
                'organization_member_id',
                'organization_members',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'organization_member_id_1_fk'
                ]
            )
            ->update();

        $this->table('organization_members')
            ->addForeignKey(
                'organization_id',
                'organizations',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'organization_id_0_fk'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'user_id_1_fk'
                ]
            )
            ->update();

        $this->table('organization_options')
            ->addForeignKey(
                'organization_id',
                'organizations',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'organization_id_0_fk'
                ]
            )
            ->update();

        $this->table('projects')
            ->addForeignKey(
                'organization_id',
                'organizations',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'organization_id_0_fk'
                ]
            )
            ->update();

        $this->table('projects_teams')
            ->addForeignKey(
                'team_id',
                'teams',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'team_id_0_fk'
                ]
            )
            ->addForeignKey(
                'project_id',
                'projects',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'project_id_1_fk'
                ]
            )
            ->update();

        $this->table('team_members')
            ->addForeignKey(
                'team_id',
                'teams',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'team_id_0_fk'
                ]
            )
            ->addForeignKey(
                'organization_member_id',
                'organization_members',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'organization_member_id_1_fk'
                ]
            )
            ->update();

        $this->table('teams')
            ->addForeignKey(
                'organization_id',
                'organizations',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'organization_id_0_fk'
                ]
            )
            ->update();

        $this->table('user_emails')
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'CASCADE',
                    'constraint' => 'user_id_0_fk'
                ]
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     * @return void
     */
    public function down(): void
    {
        $this->table('organization_invites')
            ->dropForeignKey(
                'organization_id'
            )
            ->dropForeignKey(
                'organization_member_id'
            )->save();

        $this->table('organization_members')
            ->dropForeignKey(
                'organization_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('organization_options')
            ->dropForeignKey(
                'organization_id'
            )->save();

        $this->table('projects')
            ->dropForeignKey(
                'organization_id'
            )->save();

        $this->table('projects_teams')
            ->dropForeignKey(
                'team_id'
            )
            ->dropForeignKey(
                'project_id'
            )->save();

        $this->table('team_members')
            ->dropForeignKey(
                'team_id'
            )
            ->dropForeignKey(
                'organization_member_id'
            )->save();

        $this->table('teams')
            ->dropForeignKey(
                'organization_id'
            )->save();

        $this->table('user_emails')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('options')->drop()->save();
        $this->table('organization_invites')->drop()->save();
        $this->table('organization_members')->drop()->save();
        $this->table('organization_options')->drop()->save();
        $this->table('organizations')->drop()->save();
        $this->table('projects')->drop()->save();
        $this->table('projects_teams')->drop()->save();
        $this->table('team_members')->drop()->save();
        $this->table('teams')->drop()->save();
        $this->table('user_emails')->drop()->save();
        $this->table('users')->drop()->save();
    }
}

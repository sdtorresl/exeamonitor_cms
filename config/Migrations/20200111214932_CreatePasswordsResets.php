<?php
use Migrations\AbstractMigration;

class CreatePasswordsResets extends AbstractMigration
{

    public $autoId = false;

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('passwords_resets');
        $table->addColumn('uuid', 'uuid', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('used', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('expiry_date', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'uuid',
        ]);
        $table->addForeignKey(
            'user_id',
            'users',
            'id',
            [
                'delete' => 'CASCADE', 
                'update' => 'CASCADE'
            ]
        );
        $table->create();
    }
}

<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateChecks extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('checks');
        $table->addColumn('state', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => false,
        ]);
        $table->addColumn('pos_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('volume', 'integer', [
            'default' => null,
            'limit' => 5,
            'null' => true,
        ]);
        $table->addColumn('current_song', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addForeignKey(
            'pos_id',
            'points_of_sale',
            'id',
            [
                'delete' => 'NO_ACTION', 
                'update' => 'NO_ACTION'
            ]
        );
        $table->addIndex(['created', 'pos_id']);
        $table->create();
    }
}

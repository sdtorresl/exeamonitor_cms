<?php
use Migrations\AbstractMigration;

class CreatePosPasswordsResets extends AbstractMigration
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
        $table = $this->table('pos_passwords_resets');
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
        $table->addColumn('pos_id', 'integer', [
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
            'pos_id',
            'points_of_sales',
            'id',
            [
                'delete' => 'CASCADE', 
                'update' => 'CASCADE'
            ]
        );
        $table->create();
    }
}

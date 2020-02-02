<?php
use Migrations\AbstractMigration;

class CreateCities extends AbstractMigration
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
        $table = $this->table('cities');
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('country_code', 'string', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'id',
        ]);
        $table->addForeignKey(
            'country_code',
            'countries',
            'code',
            [
                'delete' => 'CASCADE', 
                'update' => 'CASCADE'
            ]
        );
        $table->create();
    }
}

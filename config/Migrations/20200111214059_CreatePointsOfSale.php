<?php
use Migrations\AbstractMigration;

class CreatePointsOfSale extends AbstractMigration
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
        $table = $this->table('points_of_sale');
        $table->addColumn('id', 'integer', [
            'autoIncrement' => true,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('phone', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('contact', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('address', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('country_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('city_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('last_access', 'timestamp', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);
        $table->addPrimaryKey([
            'id',
        ]);
        $table->addForeignKey(
            'customer_id',
            'customers',
            'id',
            [
                'delete' => 'NO_ACTION', 
                'update' => 'NO_ACTION'
            ]
        );
        $table->addForeignKey(
            'city_id',
            'cities',
            'id',
            [
                'delete' => 'NO_ACTION', 
                'update' => 'NO_ACTION'
            ]
        );
        $table->addForeignKey(
            'country_id',
            'countries',
            'id',
            [
                'delete' => 'NO_ACTION', 
                'update' => 'NO_ACTION'
            ]
        );
        $table->create();
    }
}

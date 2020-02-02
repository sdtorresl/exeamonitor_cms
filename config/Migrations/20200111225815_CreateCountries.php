<?php
use Migrations\AbstractMigration;

class CreateCountries extends AbstractMigration
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
        $table = $this->table('countries');
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
        $table->addColumn('code', 'string', [
            'default' => null,
            'limit' => 3,
            'null' => false,
        ]);
        $table->addIndex([
            'name',
        ], [
            'name' => 'UNIQUE_NAME',
            'unique' => true,
        ]);
        $table->addIndex([
            'code',
        ], [
            'name' => 'UNIQUE_CODE',
            'unique' => true,
        ]);
        $table->addPrimaryKey([
            'id',
        ]);
        $table->create();
    }
}

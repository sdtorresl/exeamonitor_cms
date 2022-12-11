<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AlterUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('token', 'string', [
            'default' => null,
            'limit' => 36,
            'null' => true,
        ]);
        $table->addColumn('token_expiry_date', 'datetime', [
            'default' => null,
            'limit' => null,
            'null' => true,
        ]);
        $table->addColumn('token_used', 'boolean', [
            'default' => '0',
            'limit' => 4,
            'null' => false,
        ]);
        $table->addIndex(
            [
                'token',
            ],
            ['unique' => true]
        );
        $table->update();
    }
}

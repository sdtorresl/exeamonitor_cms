<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class LogCreationUser extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->addColumn('amount_customers', 'string', [
            'default' => null,
            'null' => true,
            'limit' => 255
        ]);
        $table->update();
    }
}

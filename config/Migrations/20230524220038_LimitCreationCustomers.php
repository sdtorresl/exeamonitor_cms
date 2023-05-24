<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class LimitCreationCustomers extends AbstractMigration
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
        $table = $this->table('customers');
        $table->addColumn('created_by', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}

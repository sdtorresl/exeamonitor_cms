<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class AddRulesHours extends AbstractMigration
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
        $table = $this->table('rules');
        $table->addColumn('start_hour', 'varchar', [
            'default' => null,
            'limit' => 45,
            'null' => true,
            'signed' => false
        ]);
        $table->addColumn('final_hour', 'varchar', [
            'default' => null,
            'limit' => 45,
            'null' => true,
            'signed' => false
        ]);
        $table->addColumn('days', 'varchar', [
            'default' => null,
            'limit' => 512,
            'null' => true,
            'signed' => false
        ]);
        $table->addColumn('once', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
            'signed' => false
        ]);
        $table->update();
    }
}

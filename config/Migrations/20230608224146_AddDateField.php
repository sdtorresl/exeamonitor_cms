<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddDateField extends AbstractMigration
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
        $table->addColumn('calendar', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'signed' => false
        ]);
        $table->update();
    }
}

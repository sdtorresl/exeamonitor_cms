<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\Time;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $time = Time::now();
        $time = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        $hasher = new DefaultPasswordHasher();
        $password = $hasher->hash('admin');

        $data = [
            "username" => "exeadmin", "first_name" => "Admin", "last_name" => "Exea", "role" => "admin", "password" => $password, "email" => "soporte@innovaciones.co", "enabled" => true, "last_access" => $time, "created" => $time, "modified" => $time
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}

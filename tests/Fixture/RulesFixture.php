<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RulesFixture
 */
class RulesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'tag' => 'Lorem ipsum dolor sit amet',
                'logic' => 'Lorem ipsum dolor sit amet',
                'playbook_id' => 1,
                'created' => '2022-12-13 03:04:16',
                'modified' => '2022-12-13 03:04:16',
            ],
        ];
        parent::init();
    }
}

<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlaybooksFixture
 */
class PlaybooksFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'customer_id' => 1,
                'created' => '2022-12-27 23:05:32',
                'modified' => '2022-12-27 23:05:32',
            ],
        ];
        parent::init();
    }
}

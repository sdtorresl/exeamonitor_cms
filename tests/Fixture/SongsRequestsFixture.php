<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SongsRequestsFixture
 */
class SongsRequestsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'author' => 'Lorem ipsum dolor sit amet',
                'song_id' => 1,
                'pos_id' => 1,
                'played' => 1,
                'created' => '2023-01-13 01:12:41',
                'modified' => '2023-01-13 01:12:41',
            ],
        ];
        parent::init();
    }
}

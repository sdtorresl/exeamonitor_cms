<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SongsHistoryTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SongsHistoryTable Test Case
 */
class SongsHistoryTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SongsHistoryTable
     */
    protected $SongsHistory;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SongsHistory',
        'app.PointsOfSale',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SongsHistory') ? [] : ['className' => SongsHistoryTable::class];
        $this->SongsHistory = $this->getTableLocator()->get('SongsHistory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SongsHistory);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SongsHistoryTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SongsHistoryTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

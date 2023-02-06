<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SongsRequestsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SongsRequestsTable Test Case
 */
class SongsRequestsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SongsRequestsTable
     */
    protected $SongsRequests;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.SongsRequests',
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
        $config = $this->getTableLocator()->exists('SongsRequests') ? [] : ['className' => SongsRequestsTable::class];
        $this->SongsRequests = $this->getTableLocator()->get('SongsRequests', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->SongsRequests);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SongsRequestsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SongsRequestsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

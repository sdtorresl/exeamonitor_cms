<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlaybooksTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlaybooksTable Test Case
 */
class PlaybooksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PlaybooksTable
     */
    protected $Playbooks;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Playbooks',
        'app.Customers',
        'app.Rules',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Playbooks') ? [] : ['className' => PlaybooksTable::class];
        $this->Playbooks = $this->getTableLocator()->get('Playbooks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Playbooks);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PlaybooksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\PlaybooksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

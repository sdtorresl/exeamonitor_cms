<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PointsOfSalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PointsOfSalesTable Test Case
 */
class PointsOfSalesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PointsOfSalesTable
     */
    public $PointsOfSales;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.PointsOfSales',
        'app.Customers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('PointsOfSales') ? [] : ['className' => PointsOfSalesTable::class];
        $this->PointsOfSales = TableRegistry::getTableLocator()->get('PointsOfSales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PointsOfSales);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

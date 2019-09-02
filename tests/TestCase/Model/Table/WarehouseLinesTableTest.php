<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WarehouseLinesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WarehouseLinesTable Test Case
 */
class WarehouseLinesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WarehouseLinesTable
     */
    public $WarehouseLines;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.WarehouseLines',
        'app.Products',
        'app.Warehouses'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('WarehouseLines') ? [] : ['className' => WarehouseLinesTable::class];
        $this->WarehouseLines = TableRegistry::getTableLocator()->get('WarehouseLines', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WarehouseLines);

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

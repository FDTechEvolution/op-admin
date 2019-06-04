<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BussinessPartnersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BussinessPartnersTable Test Case
 */
class BussinessPartnersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BussinessPartnersTable
     */
    public $BussinessPartners;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.BussinessPartners'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BussinessPartners') ? [] : ['className' => BussinessPartnersTable::class];
        $this->BussinessPartners = TableRegistry::getTableLocator()->get('BussinessPartners', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BussinessPartners);

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
}

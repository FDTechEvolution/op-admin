<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\WarehousesCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\WarehousesCompComponent Test Case
 */
class WarehousesCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\WarehousesCompComponent
     */
    public $WarehousesComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->WarehousesComp = new WarehousesCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WarehousesComp);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

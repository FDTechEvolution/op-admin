<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\BrandsCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\BrandsCompComponent Test Case
 */
class BrandsCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\BrandsCompComponent
     */
    public $BrandsComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->BrandsComp = new BrandsCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BrandsComp);

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

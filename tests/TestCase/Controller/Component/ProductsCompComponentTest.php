<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ProductsCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ProductsCompComponent Test Case
 */
class ProductsCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ProductsCompComponent
     */
    public $ProductsComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ProductsComp = new ProductsCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductsComp);

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

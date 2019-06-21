<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\ProductCategoriesCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\ProductCategoriesCompComponent Test Case
 */
class ProductCategoriesCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\ProductCategoriesCompComponent
     */
    public $ProductCategoriesComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->ProductCategoriesComp = new ProductCategoriesCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductCategoriesComp);

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

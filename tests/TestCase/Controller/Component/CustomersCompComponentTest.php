<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CustomersCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\CustomersCompComponent Test Case
 */
class CustomersCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\CustomersCompComponent
     */
    public $CustomersComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->CustomersComp = new CustomersCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CustomersComp);

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

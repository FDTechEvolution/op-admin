<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AddressCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AddressCompComponent Test Case
 */
class AddressCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\AddressCompComponent
     */
    public $AddressComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->AddressComp = new AddressCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AddressComp);

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

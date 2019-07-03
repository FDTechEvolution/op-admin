<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\BpartnersCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\BpartnersCompComponent Test Case
 */
class BpartnersCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\BpartnersCompComponent
     */
    public $BpartnersComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->BpartnersComp = new BpartnersCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BpartnersComp);

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

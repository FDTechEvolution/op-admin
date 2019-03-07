<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\OrgCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\OrgCompComponent Test Case
 */
class OrgCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\OrgCompComponent
     */
    public $OrgComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->OrgComp = new OrgCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrgComp);

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

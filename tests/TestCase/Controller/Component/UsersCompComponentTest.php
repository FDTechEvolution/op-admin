<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UsersCompComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UsersCompComponent Test Case
 */
class UsersCompComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\UsersCompComponent
     */
    public $UsersComp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->UsersComp = new UsersCompComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersComp);

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

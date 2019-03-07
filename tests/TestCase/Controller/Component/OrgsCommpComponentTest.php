<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\OrgsCommpComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\OrgsCommpComponent Test Case
 */
class OrgsCommpComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\OrgsCommpComponent
     */
    public $OrgsCommp;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->OrgsCommp = new OrgsCommpComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrgsCommp);

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

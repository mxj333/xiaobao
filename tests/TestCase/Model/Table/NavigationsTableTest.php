<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NavigationsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NavigationsTable Test Case
 */
class NavigationsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NavigationsTable
     */
    public $Navigations;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.navigations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Navigations') ? [] : ['className' => 'App\Model\Table\NavigationsTable'];
        $this->Navigations = TableRegistry::get('Navigations', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Navigations);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}

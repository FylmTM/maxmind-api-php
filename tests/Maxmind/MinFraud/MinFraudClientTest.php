<?php
namespace tests\Maxmind\MinFraud;

use Maxmind\MinFraud\MinFraudClient;
use Maxmind\MinFraud\MinFraudServers;

class MinFraudClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MinFraudClient
     */
    public $minFraudClient;
    protected function setUp()
    {
        $this->minFraudClient = new MinFraudClient();
    }

    public function testMainServerUsedByDefault()
    {
        $this->assertEquals(MinFraudServers::MAIN, $this->minFraudClient->getServer());
    }

    public function testAnotherServerCanBeSet()
    {
        $this->minFraudClient->setServer(MinFraudServers::US_EAST);
        $this->assertEquals(MinFraudServers::US_EAST, $this->minFraudClient->getServer());
    }

    public function testHttpsUsedByDefault()
    {
        $this->assertEquals('https', $this->minFraudClient->getProtocol());
    }

    public function testHttpsUsedWithImplicitSetup()
    {
        $this->minFraudClient->enableHttps(true);
        $this->assertEquals('https', $this->minFraudClient->getProtocol());
    }

    public function testHttpCanBeSes()
    {
        $this->minFraudClient->enableHttps(false);
        $this->assertEquals('http', $this->minFraudClient->getProtocol());
    }
}
 
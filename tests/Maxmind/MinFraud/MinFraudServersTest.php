<?php

namespace tests\Maxmind\MinFraud;

use Maxmind\MinFraud\MinFraudServers;

class MinFraudServersTest extends \PHPUnit_Framework_TestCase
{
    public function testMainServer()
    {
        $this->assertEquals('minfraud.maxmind.com', MinFraudServers::MAIN);
    }

    public function testUsEastServer()
    {
        $this->assertEquals('minfraud-us-east.maxmind.com', MinFraudServers::US_EAST);
    }

    public function testUsWestServer()
    {
        $this->assertEquals('minfraud-us-west.maxmind.com', MinFraudServers::US_WEST);
    }
}
 
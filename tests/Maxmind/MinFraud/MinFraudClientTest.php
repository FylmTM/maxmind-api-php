<?php
namespace tests\Maxmind\MinFraud;

use Maxmind\MinFraud\MinFraudClient;

class MinFraudClientTest extends \PHPUnit_Framework_TestCase
{

    public function testInitializeSuccess()
    {
        $minFraudClient = new MinFraudClient();
        $this->assertInstanceOf('Maxmind\MinFraud\MinFraudClient', $minFraudClient);
    }
}
 
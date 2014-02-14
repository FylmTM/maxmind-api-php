<?php

namespace tests\Maxmind\MinFraud;

use Maxmind\MinFraud\MinFraudResponse;

class MinFraudResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testInitializesProperly()
    {
        $response = new MinFraudResponse(true, 'result');
        $this->assertEquals(true, $response->getIsCurlSuccessful());
        $this->assertEquals('result', $response->getRawResult());
    }
}
 
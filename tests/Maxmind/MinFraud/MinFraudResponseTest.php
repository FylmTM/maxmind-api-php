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

    public function testEmptyResultIfUnsuccessfulCurl()
    {
        $response = new MinFraudResponse(false, 'error');
        $this->assertEquals(array(), $response->getResult());
    }

    public function testParsedResult()
    {
        $response = new MinFraudResponse(true, 'err=INVALID_LICENSE_KEY;proxyScore=;spamScore=;binName=;ip_isp=;ip_org=;binNameMatch=;binPhoneMatch=;binPhone=;maxmindID=');
        $this->assertEquals(array(
            'err'           => 'INVALID_LICENSE_KEY',
            'proxyScore'    => '',
            'spamScore'     => '',
            'binName'       => '',
            'ip_isp'        => '',
            'ip_org'        => '',
            'binNameMatch'  => '',
            'binPhoneMatch' => '',
            'binPhone'      => '',
            'maxmindID'     => '',
        ), $response->getResult());
    }

    public function testInvalidRawResultCorrectlyParsed()
    {
        $response = new MinFraudResponse(true, '123456');
        $this->assertEquals(array(
            '123456' => ''
        ), $response->getResult());
    }
}
 
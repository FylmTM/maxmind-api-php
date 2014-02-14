<?php
namespace tests\Maxmind\MinFraud;

use Maxmind\MinFraud\MinFraudClient;
use Maxmind\MinFraud\MinFraudRequest;
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

    public function testExecuteRequestSuccessfully()
    {
        $request = new MinFraudRequest(array(
            'i'           => '127.0.0.1',
            'city'        => 'City',
            'region'      => 'Region',
            'postal'      => '1111',
            'country'     => 'NA',
            'license_key' => '11'
        ));

        $response = $this->minFraudClient->executeRequest($request);

        $this->assertEquals(true, $response->getIsCurlSuccessful());
        $this->assertEquals(
            'distance=;countryMatch=;countryCode=;freeMail=;anonymousProxy=;score=;binMatch=;binCountry=;err=INVALID_LICENSE_KEY;proxyScore=;spamScore=;binName=;ip_isp=;ip_org=;binNameMatch=;binPhoneMatch=;binPhone=;custPhoneInBillingLoc=;highRiskCountry=;queriesRemaining=;cityPostalMatch=;shipCityPostalMatch=;maxmindID=',
            $response->getRawResult()
        );
        $this->assertEquals(array(
            'distance'              => '',
            'countryMatch'          => '',
            'countryCode'           => '',
            'freeMail'              => '',
            'anonymousProxy'        => '',
            'score'                 => '',
            'binMatch'              => '',
            'binCountry'            => '',
            'err'                   => 'INVALID_LICENSE_KEY',
            'proxyScore'            => '',
            'spamScore'             => '',
            'binName'               => '',
            'ip_isp'                => '',
            'ip_org'                => '',
            'binNameMatch'          => '',
            'binPhoneMatch'         => '',
            'binPhone'              => '',
            'custPhoneInBillingLoc' => '',
            'highRiskCountry'       => '',
            'queriesRemaining'      => '',
            'cityPostalMatch'       => '',
            'shipCityPostalMatch'   => '',
            'maxmindID'             => ''
        ), $response->getResult());
    }
}
 
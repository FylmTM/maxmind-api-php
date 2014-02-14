<?php

namespace tests\Maxmind\MinFraud;

use Maxmind\MinFraud\MinFraudRequest;

class MinFraudRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $requiredData = array(
        'i'           => '127.0.0.1',
        'city'        => 'City',
        'region'      => 'Region',
        'postal'      => '1111',
        'country'     => 'NA',
        'license_key' => '11'
    );

    /**
     * @var MinFraudRequest
     */
    private $request;

    protected function setUp()
    {
        $this->request = new MinFraudRequest($this->requiredData);
    }

    /**
     * @dataProvider getRequiredFieldForDisable
     * @expectedException \Maxmind\MinFraud\exceptions\MissingRequiredFieldException
     */
    public function testIfRequiredFieldMissedExceptionThrown($requiredFieldForDisable)
    {
        unset($this->requiredData[$requiredFieldForDisable]);
        new MinFraudRequest($this->requiredData);
    }

    public function getRequiredFieldForDisable()
    {
        return array(
            array('i'),
            array('city'),
            array('region'),
            array('postal'),
            array('country'),
            array('license_key'),
        );
    }

    public function testRequestDataSetWithRequiredData()
    {
        $this->assertEquals($this->requiredData, $this->request->getRequestData());
    }

    public function testSetShippingAddressEmpty()
    {
        $this->request->setShippingAddress(array());

        $this->assertEquals(array(
            'i'           => '127.0.0.1',
            'city'        => 'City',
            'region'      => 'Region',
            'postal'      => '1111',
            'country'     => 'NA',
            'license_key' => '11',
            'shipAddr'    => '',
            'shipCity'    => '',
            'shipRegion'  => '',
            'shipPostal'  => '',
            'shipCountry' => '',
        ), $this->request->getRequestData());
    }
    public function testSetShippingAddress()
    {
        $this->request->setShippingAddress(array(
            'shipAddr'    => '1',
            'shipCity'    => '2',
            'shipRegion'  => '3',
            'shipPostal'  => '4',
            'shipCountry' => '5',
        ));

        $this->assertEquals(array(
            'i'           => '127.0.0.1',
            'city'        => 'City',
            'region'      => 'Region',
            'postal'      => '1111',
            'country'     => 'NA',
            'license_key' => '11',
            'shipAddr'    => '1',
            'shipCity'    => '2',
            'shipRegion'  => '3',
            'shipPostal'  => '4',
            'shipCountry' => '5',
        ), $this->request->getRequestData());
    }
}
 
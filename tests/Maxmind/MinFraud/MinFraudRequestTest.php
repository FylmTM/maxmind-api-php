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
        $expectedData                   = $this->requiredData;
        $expectedData['requested_type'] = 'standard';

        $this->assertEquals($expectedData, $this->request->getRequestData());
    }

    public function testPremitRequestTypeSet()
    {
        $this->request->setRequestType('premium');

        $this->assertEquals(array(
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'premium'
        ), $this->request->getRequestData());
    }

    public function testSetShippingAddressEmpty()
    {
        $this->request->setShippingAddress(array());

        $this->assertEquals(array(
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'standard',
            'shipAddr'       => '',
            'shipCity'       => '',
            'shipRegion'     => '',
            'shipPostal'     => '',
            'shipCountry'    => '',
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
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'standard',
            'shipAddr'       => '1',
            'shipCity'       => '2',
            'shipRegion'     => '3',
            'shipPostal'     => '4',
            'shipCountry'    => '5',
        ), $this->request->getRequestData());
    }

    public function testSetUserData()
    {
        $this->request->setUserData(array(
            'domain'      => '1',
            'custPhone'   => '2',
            'emailMD5'    => '3',
            'usernameMD5' => '4',
            'passwordMD5' => '5'
        ));

        $this->assertEquals(array(
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'standard',
            'domain'         => '1',
            'custPhone'      => '2',
            'emailMD5'       => '3',
            'usernameMD5'    => '4',
            'passwordMD5'    => '5'
        ), $this->request->getRequestData());
    }

    public function testSetBinRelated()
    {
        $this->request->setBinRelated(array(
            'bin'      => '1',
            'binName'  => '2',
            'binPhone' => '3'
        ));

        $this->assertEquals(array(
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'standard',
            'bin'            => '1',
            'binName'        => '2',
            'binPhone'       => '3'
        ), $this->request->getRequestData());
    }

    public function testSetTransactionLinking()
    {
        $this->request->setTransactionLinking(array(
            'sessionID'       => '1',
            'user_agent'      => '2',
            'accept_language' => '3'
        ));

        $this->assertEquals(array(
            'i'               => '127.0.0.1',
            'city'            => 'City',
            'region'          => 'Region',
            'postal'          => '1111',
            'country'         => 'NA',
            'license_key'     => '11',
            'requested_type'  => 'standard',
            'sessionID'       => '1',
            'user_agent'      => '2',
            'accept_language' => '3'
        ), $this->request->getRequestData());
    }

    public function testSetTransactionInformation()
    {
        $this->request->setTransactionInformation(array(
            'txnID'          => '1',
            'order_amount'   => '2',
            'order_currency' => '3',
            'shopID'         => '4',
            'txn_type'       => '5'
        ));

        $this->assertEquals(array(
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'standard',
            'txnID'          => '1',
            'order_amount'   => '2',
            'order_currency' => '3',
            'shopID'         => '4',
            'txn_type'       => '5'
        ), $this->request->getRequestData());
    }

    public function testSetCreditCardCheck()
    {
        $this->request->setCreditCardCheck(array(
            'avs_result' => '1',
            'cvv_result' => '2'
        ));

        $this->assertEquals(array(
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'standard',
            'avs_result'     => '1',
            'cvv_result'     => '2'
        ), $this->request->getRequestData());
    }

    public function testSetMisc()
    {
        $this->request->setMisc(array(
            'forwardedIP' => '1'
        ));

        $this->assertEquals(array(
            'i'              => '127.0.0.1',
            'city'           => 'City',
            'region'         => 'Region',
            'postal'         => '1111',
            'country'        => 'NA',
            'license_key'    => '11',
            'requested_type' => 'standard',
            'forwardedIP'    => '1'
        ), $this->request->getRequestData());
    }

}
 
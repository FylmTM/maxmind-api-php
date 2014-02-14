<?php

namespace tests\Maxmind\MinFraud;

use Maxmind\MinFraud\MinFraudRequest;

class MinFraudRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getRequiredFieldForDisable
     * @expectedException \Maxmind\MinFraud\exceptions\MissingRequiredFieldException
     */
    public function testIfRequiredFieldMissedExceptionThrown($requiredFieldForDisable)
    {
        $requiredData = array(
            'i'           => '127.0.0.1',
            'city'        => 'City',
            'region'      => 'Region',
            'postal'      => '1111',
            'country'     => 'NA',
            'license_key' => '11'
        );
        unset($requiredData[$requiredFieldForDisable]);
        new MinFraudRequest($requiredData);
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

    public function testRequestDataSetWithReuiredData()
    {
        $requiredData = array(
            'i'           => '127.0.0.1',
            'city'        => 'City',
            'region'      => 'Region',
            'postal'      => '1111',
            'country'     => 'NA',
            'license_key' => '11'
        );

        $request = new MinFraudRequest($requiredData);
        $this->assertEquals($requiredData, $request->getRequestData());
    }
}
 
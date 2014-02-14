<?php

namespace Maxmind\MinFraud;

use Maxmind\MinFraud\exceptions\MissingRequiredFieldException;

class MinFraudRequest
{
    /**
     * @var array
     */
    private $requiredFields = array(
        'i', 'city', 'region', 'postal', 'country', 'license_key'
    );

    private $requestData = array();

    /**
     * @param array $requiredData
     * @throws exceptions\MissingRequiredFieldException
     */
    function __construct(array $requiredData)
    {
        foreach ($this->requiredFields as $requiredField) {
            if (!isset($requiredData[$requiredField])) throw new MissingRequiredFieldException($requiredField);
        }

        $this->requestData['i']           = $requiredData['i'];
        $this->requestData['city']        = $requiredData['city'];
        $this->requestData['region']      = $requiredData['region'];
        $this->requestData['postal']      = $requiredData['postal'];
        $this->requestData['country']     = $requiredData['country'];
        $this->requestData['license_key'] = $requiredData['license_key'];
    }

    /**
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * @param array $data
     */
    public function setShippingAddress(array $data)
    {
        $this->setRequestDataField('shipAddr', $data);
        $this->setRequestDataField('shipCity', $data);
        $this->setRequestDataField('shipRegion', $data);
        $this->setRequestDataField('shipPostal', $data);
        $this->setRequestDataField('shipCountry', $data);
    }

    public function setUserData(array $data)
    {
        $this->setRequestDataField('domain', $data);
        $this->setRequestDataField('custPhone', $data);
        $this->setRequestDataField('emailMD5', $data);
        $this->setRequestDataField('usernameMD5', $data);
        $this->setRequestDataField('passwordMD5', $data);
    }

    /**
     * @param $field
     * @param array $data
     * @param string $default
     */
    private function setRequestDataField($field, array $data, $default = '')
    {
        $this->requestData[$field] = $this->getDataValue($data, $field, $default);
    }

    /**
     * @param array $data
     * @param $key
     * @param string $default
     * @return mixed
     */
    private function getDataValue(array $data, $key, $default = '')
    {
        return isset($data[$key]) ? $data[$key] : $default;
    }
} 
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

        $this->setRequestType('standard');
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

    /**
     * @param array $data
     */
    public function setUserData(array $data)
    {
        $this->setRequestDataField('domain', $data);
        $this->setRequestDataField('custPhone', $data);
        $this->setRequestDataField('emailMD5', $data);
        $this->setRequestDataField('usernameMD5', $data);
        $this->setRequestDataField('passwordMD5', $data);
    }

    /**
     * @param array $data
     */
    public function setBinRelated(array $data)
    {
        $this->setRequestDataField('bin', $data);
        $this->setRequestDataField('binName', $data);
        $this->setRequestDataField('binPhone', $data);
    }

    /**
     * @param array $data
     */
    public function setTransactionLinking(array $data)
    {
        $this->setRequestDataField('sessionID', $data);
        $this->setRequestDataField('user_agent', $data);
        $this->setRequestDataField('accept_language', $data);
    }

    /**
     * @param array $data
     */
    public function setTransactionInformation(array $data)
    {
        $this->setRequestDataField('txnID', $data);
        $this->setRequestDataField('order_amount', $data);
        $this->setRequestDataField('order_currency', $data);
        $this->setRequestDataField('shopID', $data);
        $this->setRequestDataField('txn_type', $data);
    }

    /**
     * @param array $data
     */
    public function setCreditCardCheck(array $data)
    {
        $this->setRequestDataField('avs_result', $data);
        $this->setRequestDataField('cvv_result', $data);
    }

    /**
     * @param array $data
     */
    public function setMisc(array $data)
    {
        $this->setRequestDataField('forwardedIP', $data);
    }

    /**
     * @param string $requestType
     */
    public function setRequestType($requestType = 'standard')
    {
        $this->requestData['requested_type'] = $requestType;
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
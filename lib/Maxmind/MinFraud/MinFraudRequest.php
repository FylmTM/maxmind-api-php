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
} 
<?php

namespace Maxmind\MinFraud;

class MinFraudResponse
{
    private $isCurlSuccessful;
    private $rawResult;

    /**
     * @param bool $isCurlSuccessful
     * @param string $result
     */
    public function __construct($isCurlSuccessful, $result)
    {
        $this->isCurlSuccessful = $isCurlSuccessful;
        $this->rawResult        = $result;
    }

    /**
     * @return boolean
     */
    public function getIsCurlSuccessful()
    {
        return $this->isCurlSuccessful;
    }

    /**
     * @return string
     */
    public function getRawResult()
    {
        return $this->rawResult;
    }

    /**
     * @return array
     */
    public function getResult()
    {
        $result = array();
        if ($this->getIsCurlSuccessful()) {
            $keyValuePairs = explode(";", $this->getRawResult());
            foreach ($keyValuePairs as $keyValuePair) {
                $keyValue             = explode("=", $keyValuePair);
                $result[$keyValue[0]] = isset($keyValue[1]) ? $keyValue[1] : '';
            }
        }

        return $result;
    }
} 
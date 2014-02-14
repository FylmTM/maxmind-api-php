<?php

namespace Maxmind\MinFraud;

/**
 * Maxmind MinFraud client
 * @package Maxmind\MinFraud
 */
class MinFraudClient
{
    /**
     * @var string
     */
    private $server;
    /**
     * @var string
     */
    private $protocol;

    /**
     *
     */
    public function __construct()
    {
        $this->setServer(MinFraudServers::MAIN);
        $this->enableHttps();
    }

    /**
     * @return string
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param string $server
     */
    public function setServer($server = MinFraudServers::MAIN)
    {
        $this->server = $server;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param bool $enableHttps
     */
    public function enableHttps($enableHttps = true)
    {
        $this->protocol = $enableHttps === true ? 'https' : 'http';
    }

    /**
     * @param MinFraudRequest $request
     * @param int $timeout
     * @return \Maxmind\MinFraud\MinFraudResponse
     */
    public function executeRequest(MinFraudRequest $request, $timeout = 30)
    {
        $url         = $this->getProtocol() . '://' . $this->getServer() . "/app/ccv2r";
        $requestData = $request->getRequestData();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($requestData));

        $curlResult = curl_exec($ch);
        if (!$curlResult) {
            $isCurlSuccessful = false;
            $curlResult       = curl_error($ch);
        } else {
            $isCurlSuccessful = true;
        }
        curl_close($ch);

        return new MinFraudResponse($isCurlSuccessful, $curlResult);
    }
} 
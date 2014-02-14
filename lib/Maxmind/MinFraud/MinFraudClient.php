<?php

namespace Maxmind\MinFraud;

    /**
     * @package Maxmind\MinFraud
     */
/**
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
} 
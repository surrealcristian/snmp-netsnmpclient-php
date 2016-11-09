<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\Command\GetV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\GetNextV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\WalkV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\BulkWalkV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\SetV2cCommand;

class SimpleSnmpV2c
{
    protected $getV2cCommand;
    protected $getNextV2cCommand;
    protected $walkV2cCommand;
    protected $bulkWalkV2cCommand;
    protected $setV2cCommand;

    public function __construct(
        GetV2cCommand $getV2cCommand,
        GetNextV2cCommand $getNextV2cCommand,
        WalkV2cCommand $walkV2cCommand,
        BulkWalkV2cCommand $bulkWalkV2cCommand,
        SetV2cCommand $setV2cCommand
    ) {
        $this->getV2cCommand = $getV2cCommand;
        $this->getNextV2cCommand = $getNextV2cCommand;
        $this->walkV2cCommand = $walkV2cCommand;
        $this->bulkWalkV2cCommand = $bulkWalkV2cCommand;
        $this->setV2cCommand = $setV2cCommand;
    }

    public function get($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $ret = $this->getV2cCommand->execute(
            $host, $community, $oid, $timeout, $retries
        );

        return $ret;
    }

    public function getNext($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $ret = $this->getNextV2cCommand->execute(
            $host, $community, $oid, $timeout, $retries
        );

        return $ret;
    }

    public function walk($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $ret = $this->walkV2cCommand->execute(
            $host, $community, $oid, $timeout, $retries
        );

        return $ret;
    }

    public function bulkWalk($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $ret = $this->bulkWalkV2cCommand->execute(
            $host, $community, $oid, $timeout, $retries
        );

        return $ret;
    }

    public function set(
        $host, $community, $oid, $type, $value, $timeout, $retries
    ) {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $this->setV2cCommand->execute(
            $host, $community, $oid, $type, $value, $timeout, $retries
        );
    }
}

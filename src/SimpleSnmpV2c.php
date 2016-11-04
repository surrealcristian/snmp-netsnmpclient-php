<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\CommandFactory;
use SurrealCristian\SnmpNetSnmpClient\Parser;
use SurrealCristian\SnmpNetSnmpClient\SetParser;

class SimpleSnmpV2c
{
    protected $commandFactory;
    protected $parser;
    protected $setParser;

    public function __construct(
        CommandFactory $commandFactory,
        Parser $parser,
        SetParser $setParser
    ) {
        $this->commandFactory = $commandFactory;
        $this->parser = $parser;
        $this->setParser = $setParser;
    }

    public function get($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = $this->commandFactory->getGetV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $ret = $this->parser->parse($output);
        $ret = $ret[0];

        return $ret;
    }

    public function getNext($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = $this->commandFactory->getGetNextV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $ret = $this->parser->parse($output);
        $ret = $ret[0];

        return $ret;
    }

    public function walk($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = $this->commandFactory->getWalkV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $ret = $this->parser->parse($output);

        return $ret;
    }

    public function bulkWalk($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = $this->commandFactory->getBulkWalkV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $ret = $this->parser->parse($output);

        return $ret;
    }

    public function set(
        $host, $community, $oid, $type, $value, $timeout, $retries
    ) {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = $this->commandFactory->getSetV2cCommand(
            $host, $community, $oid, $type, $value, $timeout, $retries
        );
        $output = $command->execute();

        $ret = $this->setParser->parse($output);

        return $ret;
    }
}

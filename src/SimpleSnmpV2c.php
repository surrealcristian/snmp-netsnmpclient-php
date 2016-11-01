<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\BulkWalkV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\GetNextV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\GetV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\WalkV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Parser;
use SurrealCristian\SnmpNetSnmpClient\SetParser;

class SimpleSnmpV2c
{
    protected $parser;

    public function get($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = new GetV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $parser = new Parser();
        $ret = $parser->parse($output);
        $ret = $ret[0];

        return $ret;
    }

    public function getNext($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = new GetNextV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $parser = new Parser();
        $ret = $parser->parse($output);
        $ret = $ret[0];

        return $ret;
    }

    public function walk($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = new WalkV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $parser = new Parser();
        $ret = $parser->parse($output);

        return $ret;
    }

    public function bulkWalk($host, $community, $oid, $timeout, $retries)
    {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = new BulkWalkV2cCommand(
            $host, $community, $oid, $timeout, $retries
        );
        $output = $command->execute();

        $parser = new Parser();
        $ret = $parser->parse($output);

        return $ret;
    }

    public function set(
        $host, $community, $oid, $type, $value, $timeout, $retries
    ) {
        // convert from microseconds to seconds
        $timeout = intval($timeout) / 1000000;

        $retries = intval($retries);

        $command = new SetV2cCommand(
            $host, $community, $oid, $type, $value, $timeout, $retries
        );
        $output = $command->execute();

        $parser = new SetParser();
        $ret = $parser->parse($output);

        return $ret;
    }
}

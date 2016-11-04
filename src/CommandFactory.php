<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\BulkWalkV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\GetNextV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\GetV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\ProcOpenFn;
use SurrealCristian\SnmpNetSnmpClient\SetV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\WalkV2cCommand;

/**
 * @codeCoverageIgnore
 */
class CommandFactory
{
    public function getGetV2cCommand(
        $host, $community, $oid, $timeout, $retries
    ) {
        $procOpenFn = new ProcOpenFn;

        $cmd = new GetV2cCommand(
            $procOpenFn, $host, $community, $oid, $timeout, $retries
        );

        return $cmd;
    }

    public function getGetNextV2cCommand(
        $host, $community, $oid, $timeout, $retries
    ) {
        $procOpenFn = new ProcOpenFn;

        $cmd = new GetNextV2cCommand(
            $procOpenFn, $host, $community, $oid, $timeout, $retries
        );

        return $cmd;
    }

    public function getWalkV2cCommand(
        $host, $community, $oid, $timeout, $retries
    ) {
        $procOpenFn = new ProcOpenFn;

        $cmd = new WalkV2cCommand(
            $procOpenFn, $host, $community, $oid, $timeout, $retries
        );

        return $cmd;
    }

    public function getBulkWalkV2cCommand(
        $host, $community, $oid, $timeout, $retries
    ) {
        $procOpenFn = new ProcOpenFn;

        $cmd = new BulkWalkV2cCommand(
            $procOpenFn, $host, $community, $oid, $timeout, $retries
        );

        return $cmd;
    }

    public function getSetV2cCommand(
        $host, $community, $oid, $type, $value, $timeout, $retries
    ) {
        $procOpenFn = new ProcOpenFn;

        $cmd = new SetV2cCommand(
            $procOpenFn,
            $host, $community, $oid, $type, $value, $timeout, $retries
        );

        return $cmd;
    }
}

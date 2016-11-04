<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\ProcOpenFn;

class BulkWalkV2cCommand extends BaseCommand
{
    public function __construct(
        ProcOpenFn $procOpenFn, $host, $community, $oid, $timeout, $retries
    ) {
        $this->procOpenFn = $procOpenFn;

        $this->cmd = "snmpbulkwalk -v2c -c $community -Ont -t$timeout -r$retries $host $oid";
        $this->cmd = escapeshellcmd($this->cmd);
    }
}

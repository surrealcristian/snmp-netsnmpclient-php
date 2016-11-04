<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\ProcOpenFn;

class SetV2cCommand extends BaseCommand
{
    public function __construct(
        ProcOpenFn $procOpenFn,
        $host, $community, $oid, $type, $value, $timeout, $retries
    ) {
        $this->procOpenFn = $procOpenFn;

        $this->cmd = "snmpset -v2c -c $community -Ont -t$timeout -r$retries $host $oid $type \"$value\"";
        $this->cmd = escapeshellcmd($this->cmd);
    }
}

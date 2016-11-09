<?php

namespace SurrealCristian\SnmpNetSnmpClient\Command;

use SurrealCristian\SnmpNetSnmpClient\Parser\Parser;
use SurrealCristian\SnmpNetSnmpClient\ProcOpenFn;

class SetV2cCommand
{
    protected $procOpenFn;

    public function __construct(ProcOpenFn $procOpenFn)
    {
        $this->procOpenFn = $procOpenFn;
    }

    public function execute(
        $host, $community, $oid, $type, $value, $timeout, $retries
    ) {
        $cmd = "snmpset -v2c -c $community -Ont -t$timeout -r$retries $host $oid $type $value";
        $cmd = escapeshellcmd($cmd);

        $this->procOpenFn->execute($cmd);
    }
}

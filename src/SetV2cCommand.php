<?php

namespace SurrealCristian\SnmpNetSnmpClient;

class SetV2cCommand extends BaseCommand
{
    public function __construct($host, $community, $oid, $type, $value, $timeout, $retries)
    {
        $this->cmd = "snmpset -v2c -c $community -Ont -t$timeout -r$retries $host $oid $type \"$value\"";
        $this->cmd = escapeshellcmd($this->cmd);
    }
}

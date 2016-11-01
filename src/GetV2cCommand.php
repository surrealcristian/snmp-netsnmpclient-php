<?php

namespace SurrealCristian\SnmpNetSnmpClient;

class GetV2cCommand extends BaseCommand
{
    public function __construct($host, $community, $oid, $timeout, $retries)
    {
        $this->cmd = "snmpget -v2c -c $community -Ont -t$timeout -r$retries $host $oid";
        $this->cmd = escapeshellcmd($this->cmd);
    }
}

<?php

namespace SurrealCristian\SnmpNetSnmpClient;

class GetNextV2cCommand extends BaseCommand
{
    public function __construct($host, $community, $oid, $timeout, $retries)
    {
        $this->cmd = "snmpgetnext -v2c -c $community -Ont -t$timeout -r$retries $host $oid";
        $this->cmd = escapeshellcmd($this->cmd);
    }
}

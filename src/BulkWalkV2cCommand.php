<?php

namespace SurrealCristian\SnmpNetSnmpClient;

class BulkWalkV2cCommand extends BaseCommand
{
    public function __construct($host, $community, $oid, $timeout, $retries)
    {
        $this->cmd = "snmpbulkwalk -v2c -c $community -Ont -t$timeout -r$retries $host $oid";
        $this->cmd = escapeshellcmd($this->cmd);
    }
}

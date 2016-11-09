<?php

namespace SurrealCristian\SnmpNetSnmpClient\Command;

use SurrealCristian\SnmpNetSnmpClient\Parser\Parser;
use SurrealCristian\SnmpNetSnmpClient\ProcOpenFn;

class WalkV2cCommand
{
    protected $procOpenFn;
    protected $parser;

    public function __construct(
        ProcOpenFn $procOpenFn, Parser $parser
    ) {
        $this->procOpenFn = $procOpenFn;
        $this->parser = $parser;
    }

    public function execute($host, $community, $oid, $timeout, $retries)
    {
        $cmd = "snmpwalk -v2c -c $community -Ont -t$timeout -r$retries $host $oid";
        $cmd = escapeshellcmd($cmd);

        $fnret = $this->procOpenFn->execute($cmd);

        $ret = $this->parser->parse($fnret);

        return $ret;
    }
}

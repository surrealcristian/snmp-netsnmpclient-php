<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\Command\GetV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\GetNextV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\WalkV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\BulkWalkV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Command\SetV2cCommand;

use SurrealCristian\SnmpNetSnmpClient\Parser\LineFactory;
use SurrealCristian\SnmpNetSnmpClient\Parser\Parser;
use SurrealCristian\SnmpNetSnmpClient\Parser\ProcOpenFnParser;
use SurrealCristian\SnmpNetSnmpClient\ProcOpenFn;

use SurrealCristian\SnmpNetSnmpClient\SimpleSnmpV2c;

/**
 * @codeCoverageIgnore
 */
class Builder
{
    public function getSimpleSnmpV2c()
    {
        $procOpenFn = new ProcOpenFn(new ProcOpenFnParser);
        $parser = new Parser(new LineFactory);

        $getCmd = new GetV2cCommand($procOpenFn, $parser);
        $getNextCmd = new GetNextV2cCommand($procOpenFn, $parser);
        $walkCmd = new WalkV2cCommand($procOpenFn, $parser);
        $bulkWalkCmd = new BulkWalkV2cCommand($procOpenFn, $parser);
        $setCmd = new SetV2cCommand($procOpenFn);
        
        $simpleSnmpV2c = new SimpleSnmpV2c(
            $getCmd, $getNextCmd, $walkCmd, $bulkWalkCmd, $setCmd
        );

        return $simpleSnmpV2c;
    }
}

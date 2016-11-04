<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\LineFactory;
use SurrealCristian\SnmpNetSnmpClient\Parser;
use SurrealCristian\SnmpNetSnmpClient\SetParser;
use SurrealCristian\SnmpNetSnmpClient\SimpleSnmpV2c;

/**
 * @codeCoverageIgnore
 */
class Builder
{
    public function getSimpleSnmpV2c()
    {
        $lineFactory = new LineFactory;

        $commandFactory = new CommandFactory;
        $parser = new Parser($lineFactory);
        $setParser = new SetParser;
        
        $simpleSnmpV2c = new SimpleSnmpV2c(
            $commandFactory, $parser, $setParser
        );

        return $simpleSnmpV2c;
    }
}

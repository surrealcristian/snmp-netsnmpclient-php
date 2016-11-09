<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser;

use SurrealCristian\SnmpNetSnmpClient\Parser\Line;

/**
 * @codeCoverageIgnore
 */
class LineFactory
{
    public function makeLine($rawLine)
    {
        $line = new Line($rawLine);

        return $line;
    }
}

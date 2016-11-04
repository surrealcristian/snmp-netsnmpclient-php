<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SnmpNetSnmpClient\Line;

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

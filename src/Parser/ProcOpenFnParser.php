<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser;

use SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException;
use SurrealCristian\SimpleSnmp\Exception\TimeoutException;
use SurrealCristian\SnmpNetSnmpClient\Str;

class ProcOpenFnParser
{
    public function parse($fnret)
    {
        if ($fnret['stderr'] !== "") {
            if (Str::startsWith($fnret['stderr'], 'Timeout:')) {
                throw new TimeoutException();
            }

            throw new SimpleSnmpException($fnret['stderr']);
        }

        return $fnret['stdout'];
    }
}

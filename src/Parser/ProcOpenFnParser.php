<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser;

use SurrealCristian\SnmpNetSnmpClient\Exception\SnmpNetSnmpClientException;
use SurrealCristian\SnmpNetSnmpClient\Exception\TimeoutException;
use SurrealCristian\SnmpNetSnmpClient\Str;

class ProcOpenFnParser
{
    public function parse($fnret)
    {
        if ($fnret['stderr'] !== "") {
            if (Str::startsWith($fnret['stderr'], 'Timeout:')) {
                throw new TimeoutException();
            }

            throw new SnmpNetSnmpClientException($fnret['stderr']);
        }

        return $fnret['stdout'];
    }
}

<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use RuntimeException;
use SurrealCristian\SnmpNetSnmpClient\ProcOpenFn;
use SurrealCristian\SnmpNetSnmpClient\Str;
use SurrealCristian\SnmpNetSnmpClient\TimeoutException;

class BaseCommand
{
    protected $procOpenFn;
    protected $cmd;

    public function execute()
    {
        $res = $this->procOpenFn->execute($this->cmd);

        if ($res['stderr'] !== "") {
            if (Str::startsWith($res['stderr'], 'Timeout:')) {
                throw new TimeoutException();
            }

            throw new RuntimeException($res['stderr']);
        }

        return $res['stdout'];
    }
}

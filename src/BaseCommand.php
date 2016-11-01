<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use RuntimeException;
use SurrealCristian\SnmpNetSnmpClient\Str;
use SurrealCristian\SnmpNetSnmpClient\TimeoutException;

class BaseCommand
{
    protected $cmd;

    public function execute()
    {
        $descriptorspec = array(
            array("pipe", "r"),
            array("pipe", "w"),
            array("pipe", "w"),
        );

        $pipes = null;

        $process = proc_open($this->cmd, $descriptorspec, $pipes);

        if ($process === false) {
            throw new RuntimeException('Could not open the process');
        }

        $stdout = trim(stream_get_contents($pipes[1]));
        fclose($pipes[1]);

        $stderr = trim(stream_get_contents($pipes[2]));
        fclose($pipes[2]);

        $tmp = proc_close($process);

        if ($stderr !== "") {
            if (Str::startsWith($stderr, 'Timeout:')) {
                throw new TimeoutException();
            }

            throw new RuntimeException($stderr);
        }

        return $stdout;
    }
}

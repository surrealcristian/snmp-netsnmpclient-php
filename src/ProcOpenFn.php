<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use RuntimeException;

/**
 * @codeCoverageIgnore
 */
class ProcOpenFn
{
    public function execute($cmd)
    {
        $descriptorspec = array(
            array("pipe", "r"),
            array("pipe", "w"),
            array("pipe", "w"),
        );

        $pipes = null;

        $process = proc_open($cmd, $descriptorspec, $pipes);

        if ($process === false) {
            throw new RuntimeException('Could not open the process');
        }

        $stdout = trim(stream_get_contents($pipes[1]));
        fclose($pipes[1]);

        $stderr = trim(stream_get_contents($pipes[2]));
        fclose($pipes[2]);

        $tmp = proc_close($process);

        $ret = array(
            'stdout' => $stdout,
            'stderr' => $stderr,
        );

        return $ret;
    }
}

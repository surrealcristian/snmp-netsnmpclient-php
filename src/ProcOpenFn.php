<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException;
use SurrealCristian\SnmpNetSnmpClient\Parser\ProcOpenFnParser;

/**
 * @codeCoverageIgnore
 */
class ProcOpenFn
{
    protected $parser;

    public function __construct(ProcOpenFnParser $parser)
    {
        $this->parser = $parser;
    }

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
            throw new SimpleSnmpException('Could not open the process');
        }

        $stdout = trim(stream_get_contents($pipes[1]));
        fclose($pipes[1]);

        $stderr = trim(stream_get_contents($pipes[2]));
        fclose($pipes[2]);

        $tmp = proc_close($process);

        $fnret = array(
            'stdout' => $stdout,
            'stderr' => $stderr,
        );

        $ret = $this->parser->parse($fnret);

        return $ret;
    }
}

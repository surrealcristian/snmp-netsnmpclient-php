<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use RuntimeException;
use SurrealCristian\SnmpNetSnmpClient\Str;

class SetParser
{
    protected $buffer;
    protected $ret;

    public function parse($rawResponse)
    {
        $this->ret = array();
        $this->buffer = array();

        $rawLines = explode("\n", trim($rawResponse));

        unset($rawResponse);

        $this->ret = $rawLines;

        return $this->ret;
    }
}

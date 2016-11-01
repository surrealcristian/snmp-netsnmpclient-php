<?php

namespace SurrealCristian\SnmpNetSnmpClient;

use RuntimeException;
use SurrealCristian\SnmpNetSnmpClient\Line;

class Parser
{
    protected $buffer;
    protected $ret;

    public function parse($rawResponse)
    {
        $this->ret = array();
        $this->buffer = array();

        $rawLines = explode("\n", trim($rawResponse));

        unset($rawResponse);

        foreach ($rawLines as $rawLine) {
            $line = new Line($rawLine);
            $line->parse();

            if (
                $line->type === 'OID_TYPEOPT_VALUE'
                && !empty($this->buffer)
            ) {
                $this->processBuffer();
            }

            $this->buffer[] = $line;
        }

        $this->processBuffer();

        return $this->ret;
    }

    protected function processBuffer()
    {
        if (empty($this->buffer)) {
            throw new RuntimeException('Empty line objects buffer');
        }

        $firstLine = array_shift($this->buffer);

        if ($firstLine->type !== 'OID_TYPEOPT_VALUE') {
            $msg = 'The type of the first element of the line objects buffer is not OID_TYPEOPT_VALUE';
            throw new RuntimeException($msg);
        }

        $value = $firstLine->data['value'];

        foreach ($this->buffer as $line) {
            $value .= "\n" . $line->raw;
        }

        $parsedLine = array(
            'oid' => $firstLine->data['oid'],
            'type' => $firstLine->data['type'],
            'value' => $value,
        );

        $this->ret[] = $parsedLine;

        $this->buffer = array();
    }
}

<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser;

use SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException;
use SurrealCristian\SnmpNetSnmpClient\Parser\LineFactory;

class Parser
{
    protected $lineFactory;
    protected $buffer;
    protected $ret;

    public function __construct(LineFactory $lineFactory)
    {
        $this->lineFactory = $lineFactory;
    }

    public function parse($rawResponse)
    {
        $this->ret = array();
        $this->buffer = array();

        $rawLines = explode("\n", trim($rawResponse));

        unset($rawResponse);

        foreach ($rawLines as $rawLine) {
            $line = $this->lineFactory->makeLine($rawLine);
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
        $firstLine = array_shift($this->buffer);

        if ($firstLine->type !== 'OID_TYPEOPT_VALUE') {
            $msg = 'The type of the first element of the line objects buffer is not OID_TYPEOPT_VALUE';
            throw new SimpleSnmpException($msg);
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

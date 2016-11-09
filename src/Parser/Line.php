<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser;

class Line
{
    public $raw;
    public $parsed;
    public $type;
    public $data;

    protected $patternOidAndResponse;

    public function __construct($raw)
    {
        $this->raw = $raw;
        $this->parsed = false;
        $this->type = null;
        $this->data = null;

        $this->patternOidTypeOptValue = '/^(?<oid>\.{0,1}([0-9]+\.)*[0-9]+) = ((?<type>[a-zA-Z0-9-]+): ){0,1}(?<value>.*)$/';
    }

    public function parse()
    {
        $matches = array();
        $tmp = preg_match($this->patternOidTypeOptValue, $this->raw, $matches);

        if ($tmp === 1) {
            $this->type = 'OID_TYPEOPT_VALUE';

            $valueType = ($matches['type'] !== '')
                ? $matches['type']
                : null;

            $this->data = array(
                'oid' => trim($matches['oid'], '.'),
                'type' => $valueType,
                'value' => $matches['value'],
            );
            $this->parsed = true;

            return;
        }

        $this->type = 'RESPONSE_PART';
        $this->parsed = true;
    }
}

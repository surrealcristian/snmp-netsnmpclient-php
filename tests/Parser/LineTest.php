<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\Parser\Line;

class LineTest extends PHPUnit_Framework_TestCase
{
    public function parseProvider()
    {
        $ret = array();

        $oid = '.1.2.3.0';

        $rawLine = "$oid = STRING: \"foo 0\"";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => 'STRING',
                    'value' => '"foo 0"',
                ),
            ),
        );

        $rawLine = "$oid = OID: .1.2.4.0";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => 'OID',
                    'value' => '.1.2.4.0',
                ),
            ),
        );

        $rawLine = "$oid = INTEGER: 72";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => 'INTEGER',
                    'value' => '72',
                ),
            ),
        );

        $rawLine = "$oid = \"\"";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => null,
                    'value' => '""',
                ),
            ),
        );

        $rawLine = "$oid = 777";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => null,
                    'value' => '777',
                ),
            ),
        );

        $rawLine = "$oid = Gauge32: 1000000000";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => 'Gauge32',
                    'value' => '1000000000',
                ),
            ),
        );

        $rawLine = "$oid = Hex-STRING: 00 11 22 AA BB CC";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => 'Hex-STRING',
                    'value' => '00 11 22 AA BB CC',
                ),
            ),
        );

        $rawLine = "$oid = IpAddress: 127.0.0.1";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'OID_TYPEOPT_VALUE',
                'data' => array(
                    'oid' => $oid,
                    'type' => 'IpAddress',
                    'value' => '127.0.0.1',
                ),
            ),
        );

        $rawLine = "AA BB CC DD";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'RESPONSE_PART',
                'data' => null,
            ),
        );

        $rawLine = "AB=Foo, Bar";
        $ret[] = array(
            $rawLine,
            array(
                'raw' => $rawLine,
                'parsed' => true,
                'type' => 'RESPONSE_PART',
                'data' => null,
            ),
        );

        return $ret;
    }

    /**
     * @dataProvider parseProvider
     */
    public function testParse($rawLine, $expected)
    {
        $line = new Line($rawLine);
        $line->parse();

        $actual = array(
            'raw' => $line->raw,
            'parsed' => $line->parsed,
            'type' => $line->type,
            'data' => $line->data,
        );

        $this->assertEquals($expected, $actual);
    }
}

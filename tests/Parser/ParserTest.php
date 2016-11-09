<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\Parser\LineFactory;
use SurrealCristian\SnmpNetSnmpClient\Parser\Parser;

class ParserTest extends PHPUnit_Framework_TestCase
{
    protected function get()
    {
        $obj = new Parser(new LineFactory);

        return $obj;
    }

    public function testParse()
    {
        $parser = $this->get();

        $rawResponse = <<<EOS
1.2.3.0 = Hex-STRING: AA 00 BB 11
CC 22 DD 33
1.2.4.0 = INTEGER: 10
1.2.5.0 = IpAddress: 127.0.0.1
1.2.6.0 = 20

EOS;

        $actual = $parser->parse($rawResponse);

        $expected = array(
            array(
                'oid' => '1.2.3.0',
                'type' => 'Hex-STRING',
                'value' => "AA 00 BB 11\nCC 22 DD 33",
            ),
            array(
                'oid' => '1.2.4.0',
                'type' => 'INTEGER',
                'value' => '10',
            ),
            array(
                'oid' => '1.2.5.0',
                'type' => 'IpAddress',
                'value' => '127.0.0.1',
            ),
            array(
                'oid' => '1.2.6.0',
                'type' => null,
                'value' => '20',
            ),
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException SurrealCristian\SimpleSnmp\Exception\SimpleSnmpException
     */
    public function testParseThrowsBaseException()
    {
        $parser = $this->get();

        $rawResponse = '';

        $parser->parse($rawResponse);
    }
}

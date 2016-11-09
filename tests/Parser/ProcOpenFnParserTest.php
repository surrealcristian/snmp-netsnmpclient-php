<?php

namespace SurrealCristian\SnmpNetSnmpClient\Parser\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\Parser\ProcOpenFnParser;

class ProcOpenFnParserTest extends PHPUnit_Framework_TestCase
{
    protected function get()
    {
        $obj = new ProcOpenFnParser;

        return $obj;
    }

    public function testParse()
    {
        $stdout = "1.2.3.0 = INTEGER: 10\n1.2.3.1 = INTEGER: 11";

        $fnret = array(
            'stdout' => $stdout,
            'stderr' => '',
        );

        $parser = $this->get();
        $actual = $parser->parse($fnret);

        $expected = $stdout;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException SurrealCristian\SnmpNetSnmpClient\Exception\TimeoutException
     */
    public function testParseThrowsTimeoutException()
    {
        $fnret = array(
            'stdout' => '',
            'stderr' => 'Timeout: No Response from 127.0.0.1',
        );

        $parser = $this->get();
        $parser->parse($fnret);
    }

    /**
     * @expectedException SurrealCristian\SnmpNetSnmpClient\Exception\SnmpNetSnmpClientException
     */
    public function testParseThrowsBaseException()
    {
        $fnret = array(
            'stdout' => '',
            'stderr' => 'Error: foo bar baz',
        );

        $parser = $this->get();
        $parser->parse($fnret);
    }
}

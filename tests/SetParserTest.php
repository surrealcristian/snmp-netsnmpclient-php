<?php

namespace SurrealCristian\SnmpNetSnmpClient\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\SetParser;

class SetParserTest extends PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $rawResponse = <<<EOS

What returns
a successful SET command?

EOS;

        $parser = new SetParser;

        $actual = $parser->parse($rawResponse);

        $expected = array(
            'What returns',
            'a successful SET command?',
        );

        $this->assertEquals($expected, $actual);
    }
}

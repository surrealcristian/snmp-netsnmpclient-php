<?php

namespace SurrealCristian\SnmpNetSnmpClient\Command\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\Command\GetNextV2cCommand;
use SurrealCristian\SnmpNetSnmpClient\Parser\LineFactory;
use SurrealCristian\SnmpNetSnmpClient\Parser\Parser;

class GetNextV2cCommandTest extends PHPUnit_Framework_TestCase
{
    protected $procOpenFnMock;

    protected function setUp()
    {
        $this->procOpenFnMock = $this->getMockBuilder('SurrealCristian\SnmpNetSnmpClient\ProcOpenFn')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function get()
    {
        $obj = new GetNextV2cCommand(
            $this->procOpenFnMock, new Parser(new LineFactory)
        );

        return $obj;
    }

    public function testExecute()
    {
        $retval = '1.2.3.1 = INTEGER: 77';

        $this->procOpenFnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $actual = $cmd->execute('127.0.0.1', 'private', '1.2.3.0', 500000, 3);

        $expected = array(
            'oid' => '1.2.3.1',
            'type' => 'INTEGER',
            'value' => '77',
        );

        $this->assertEquals($expected, $actual);
    }
}

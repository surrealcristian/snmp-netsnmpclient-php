<?php

namespace SurrealCristian\SnmpNetSnmpClient\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\GetNextV2cCommand;

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
            $this->procOpenFnMock, '127.0.0.1', 'private', '1.2.3.0', 500000, 3
        );

        return $obj;
    }

    public function testExecute()
    {
        $retval = array(
            'stdout' => '1.2.3.0 = INTEGER: 77',
            'stderr' => '',
        );

        $this->procOpenFnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $actual = $cmd->execute();

        $expected = '1.2.3.0 = INTEGER: 77';

        $this->assertEquals($expected, $actual);
    }
}

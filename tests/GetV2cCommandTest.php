<?php

namespace SurrealCristian\SnmpNetSnmpClient\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\GetV2cCommand;

class GetV2cCommandTest extends PHPUnit_Framework_TestCase
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
        $obj = new GetV2cCommand(
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

    /**
     * @expectedException SurrealCristian\SnmpNetSnmpClient\TimeoutException
     */
    public function testExecuteThrowsTimeoutException()
    {
        $retval = array(
            'stdout' => '',
            'stderr' => 'Timeout: No Response from 127.0.0.1',
        );

        $this->procOpenFnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $cmd->execute();
    }

    /**
     * @expectedException Exception
     */
    public function testExecuteThrowsException()
    {
        $retval = array(
            'stdout' => '',
            'stderr' => 'Error: Foo bar baz',
        );

        $this->procOpenFnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $cmd->execute();
    }
}

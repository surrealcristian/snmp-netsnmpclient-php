<?php

namespace SurrealCristian\SnmpNetSnmpClient\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\SetV2cCommand;

class SetV2cCommandTest extends PHPUnit_Framework_TestCase
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
        $obj = new SetV2cCommand(
            $this->procOpenFnMock,
            '127.0.0.1', 'private', '1.2.3.0', 'INTEGER', 77, 500000, 3
        );

        return $obj;
    }

    public function testExecute()
    {
        $retval = array(
            'stdout' => '',
            'stderr' => '',
        );

        $this->procOpenFnMock
            ->method('execute')
            ->will($this->returnValue($retval));

        $cmd = $this->get();

        $actual = $cmd->execute();

        $expected = '';

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

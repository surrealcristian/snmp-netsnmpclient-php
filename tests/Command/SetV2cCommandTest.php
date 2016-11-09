<?php

namespace SurrealCristian\SnmpNetSnmpClient\Command\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\Command\SetV2cCommand;

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
            $this->procOpenFnMock
        );

        return $obj;
    }

    public function testExecute()
    {
        $this->procOpenFnMock
            ->method('execute')
            ->will($this->returnValue(null));

        $cmd = $this->get();

        $actual = $cmd->execute(
            '127.0.0.1', 'private', '1.2.3.0', 'INTEGER', 77, 500000, 3
        );

        $this->assertEquals(null, $actual);
    }
}

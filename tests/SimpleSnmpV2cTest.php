<?php

namespace SurrealCristian\SnmpNetSnmpClient\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\CommandFactory;
use SurrealCristian\SnmpNetSnmpClient\LineFactory;
use SurrealCristian\SnmpNetSnmpClient\Parser;
use SurrealCristian\SnmpNetSnmpClient\SetParser;
use SurrealCristian\SnmpNetSnmpClient\SimpleSnmpV2c;

class SimpleSnmpV2cTest extends PHPUnit_Framework_TestCase
{
    protected $commandFactory;

    protected function setUp()
    {
        $this->commandFactoryMock = $this->getMockBuilder('SurrealCristian\SnmpNetSnmpClient\CommandFactory')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function get()
    {
        $obj = new SimpleSnmpV2c(
            $this->commandFactoryMock,
            new Parser(new LineFactory),
            new SetParser
        );

        return $obj;
    }

    public function testGet()
    {
        $getV2cCommand = $this->getMockBuilder('SurrealCristian\SnmpNetSnmpClient\GetV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $retval = '.1.2.3.0 = STRING: "foo bar"';

        $getV2cCommand
            ->method('execute')
            ->will($this->returnValue($retval));

        $this->commandFactoryMock
            ->method('getGetV2cCommand')
            ->will($this->returnValue($getV2cCommand));

        $snmp = $this->get();

        $actual = $snmp->get(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $expected = array(
            'oid' => '.1.2.3.0',
            'type' => 'STRING',
            'value' => '"foo bar"',
        );

        $this->assertEquals($expected, $actual);
    }

    public function testGetNext()
    {
        $getNextV2cCommand = $this->getMockBuilder('SurrealCristian\SnmpNetSnmpClient\GetNextV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $retval = '.1.2.3.1 = STRING: "foo bar"';

        $getNextV2cCommand
            ->method('execute')
            ->will($this->returnValue($retval));

        $this->commandFactoryMock
            ->method('getGetNextV2cCommand')
            ->will($this->returnValue($getNextV2cCommand));

        $snmp = $this->get();

        $actual = $snmp->getNext(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $expected = array(
            'oid' => '.1.2.3.1',
            'type' => 'STRING',
            'value' => '"foo bar"',
        );

        $this->assertEquals($expected, $actual);
    }

    public function testWalk()
    {
        $walkV2cCommand = $this->getMockBuilder('SurrealCristian\SnmpNetSnmpClient\WalkV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $retval = <<<EOQ
.1.2.3.0 = STRING: "foo bar 00"
.1.2.3.1 = STRING: "foo bar 01"
EOQ;

        $walkV2cCommand
            ->method('execute')
            ->will($this->returnValue($retval));

        $this->commandFactoryMock
            ->method('getWalkV2cCommand')
            ->will($this->returnValue($walkV2cCommand));

        $snmp = $this->get();

        $actual = $snmp->walk(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $expected = array(
            array(
                'oid' => '.1.2.3.0',
                'type' => 'STRING',
                'value' => '"foo bar 00"',
            ),
            array(
                'oid' => '.1.2.3.1',
                'type' => 'STRING',
                'value' => '"foo bar 01"',
            ),
        );

        $this->assertEquals($expected, $actual);
    }

    public function testBulkWalk()
    {
        $bulkWalkV2cCommand = $this->getMockBuilder('SurrealCristian\SnmpNetSnmpClient\BulkWalkV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $retval = <<<EOQ
.1.2.3.0 = STRING: "foo bar 00"
.1.2.3.1 = STRING: "foo bar 01"
EOQ;

        $bulkWalkV2cCommand
            ->method('execute')
            ->will($this->returnValue($retval));

        $this->commandFactoryMock
            ->method('getBulkWalkV2cCommand')
            ->will($this->returnValue($bulkWalkV2cCommand));

        $snmp = $this->get();

        $actual = $snmp->bulkWalk(
            '127.0.0.1', 'private', '.1.2.3.0', 500000, 3
        );

        $expected = array(
            array(
                'oid' => '.1.2.3.0',
                'type' => 'STRING',
                'value' => '"foo bar 00"',
            ),
            array(
                'oid' => '.1.2.3.1',
                'type' => 'STRING',
                'value' => '"foo bar 01"',
            ),
        );

        $this->assertEquals($expected, $actual);
    }

    public function testSet()
    {
        $setV2cCommand = $this->getMockBuilder('SurrealCristian\SnmpNetSnmpClient\SetV2cCommand')
            ->disableOriginalConstructor()
            ->getMock();

        $retval = <<<EOQ
What returns
a successful SET command?

EOQ;

        $setV2cCommand
            ->method('execute')
            ->will($this->returnValue($retval));

        $this->commandFactoryMock
            ->method('getSetV2cCommand')
            ->will($this->returnValue($setV2cCommand));

        $snmp = $this->get();

        $actual = $snmp->set(
            '127.0.0.1', 'private', '.1.2.3.0', 's', 'test', 500000, 3
        );

        $expected = array(
            'What returns',
            'a successful SET command?',
        );

        $this->assertEquals($expected, $actual);
    }
}

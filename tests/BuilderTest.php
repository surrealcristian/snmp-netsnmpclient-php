<?php

namespace SurrealCristian\SnmpNetSnmpClient\Test;

use PHPUnit_Framework_TestCase;
use SurrealCristian\SnmpNetSnmpClient\Builder;
use SurrealCristian\SnmpNetSnmpClient\SimpleSnmpV2c;

class BuilderTest extends PHPUnit_Framework_TestCase
{
    public function testGetSimpleSnmpV2c()
    {
        $builder = new Builder();
        $snmp = $builder->getSimpleSnmpV2c();

        $this->assertInstanceOf(SimpleSnmpV2c::class, $snmp);
    }
}

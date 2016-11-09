# SNMP Net-SNMP Client

Wrapper over the Net-SNMP CLI client. Serves as an alternative to the PHP SNMP
extension.


## Install

Via Composer

``` bash
$ composer require surrealcristian/snmp-netsnmpclient
```


## Requirements

- PHP 5.4+
- Net-SNMP CLI client (`sudo apt-get install snmp`)


## Usage


### `SimpleSnmpV2c`

#### `setup`

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use SurrealCristian\SnmpNetSnmpClient\Builder;
use SurrealCristian\SnmpNetSnmpClient\Exception\SnmpNetSnmpClientException;
use SurrealCristian\SnmpNetSnmpClient\Exception\TimeoutException;

$host = '127.0.0.1';
$community = 'private';
$timeout = 1000000; // microseconds
$retries = 3;

$snmp = (new Builder)->getSimpleSnmpV2c();
```

#### `get`

```php
<?php

try {
    $oid = '1.2.3.4.5.0';

    $res = $snmp->get($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SnmpNetSnmpClientException $e) {
    // handle exception
}

// array (
//   'oid' => '1.2.3.4.5.0',
//   'type' => 'STRING',
//   'value' => '"foo 0"',
// )
```

#### `getNext`

```php
<?php

try {
    $oid = '1.2.3.4.5.0';

    $res = $snmp->getNext($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SnmpNetSnmpClientException $e) {
    // handle exception
}

// array (
//   'oid' => '1.2.3.4.5.1',
//   'type' => 'STRING',
//   'value' => '"foo 1"',
// )
```

#### `walk`

```php
<?php

try {
    $oid = '1.2.3.4.5';

    $res = $snmp->walk($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SnmpNetSnmpClientException $e) {
    // handle exception
}

// array (
//   0 => array (
//     'oid' => '1.2.3.4.5.0',
//     'type' => 'STRING',
//     'value' => '"foo 0"',
//   ),
//   1 => array (
//     'oid' => '1.2.3.4.5.1',
//     'type' => 'STRING',
//     'value' => '"foo 1"',
//   ),
// )
```

#### `bulkWalk`

```php
<?php

try {
    $oid = '1.2.3.4.5';

    $res = $snmp->bulkWalk($host, $community, $oid, $timeout, $retries);

    var_export($res);
} catch (TimeoutException $e) {
    // handle exception
} catch (SnmpNetSnmpClientException $e) {
    // handle exception
}

// array (
//   0 => array (
//     'oid' => '1.2.3.4.5.0',
//     'type' => 'STRING',
//     'value' => '"foo 0"',
//   ),
//   1 => array (
//     'oid' => '1.2.3.4.5.1',
//     'type' => 'STRING',
//     'value' => '"foo 1"',
//   ),
// )
```

#### `set`

```php
<?php

try {
    $oid = '1.2.3.4.6.0';

    $snmp->set($host, $community, $oid, 's', 'test', $timeout, $retries);
} catch (TimeoutException $e) {
    // handle exception
} catch (SnmpNetSnmpClientException $e) {
    // handle exception
}
```


## API

```
namespace SurrealCristian\SnmpNetSnmpClient


class Builder

public SimpleSnmpV2c getSimpleSnmpV2c ()


class SimpleSnmpV2c

public array get ( string $host, string $community, string $oid, int $timeout, int $retries )

public array getNext ( string $host, string $community, string $oid, int $timeout, int $retries )

public array walk ( string $host, string $community, string $oid, int $timeout, int $retries )

public array bulkWalk ( string $host, string $community, string $oid, int $timeout, int $retries )

public set ( string $host, string $community, string $oid, string $type, string $value, int $timeout, int $retries )
```


## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information


## Testing

```bash
$ cd /path/to/repo
$ phpunit
```


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

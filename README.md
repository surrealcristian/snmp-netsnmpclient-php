# SNMP Net-SNMP Client

**WORK IN PROGRESS**, the API can have some changes.

Wrapper over the Net-SNMP CLI client.


## Dependencies

- PHP >= 5.3
- Net-SNMP CLI client


## API

```
namespace SurrealCristian\SnmpNetSnmpClient


class SimpleSnmpV2c

public array get(string $host, string $community, string $oid, int $timeout, int $retries)

public array getNext(string $host, string $community, string $oid, int $timeout, int $retries)

public array walk(string $host, string $community, string $oid, int $timeout, int $retries)

public array bulkWalk(string $host, string $community, string $oid, int $timeout, int $retries)

public set(string $host, string $community, string $oid, string $type, string $value, int $timeout, int $retries)
```


## Usage


### `SimpleSnmpV2c`

#### `setup`

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use SurrealCristian\SnmpNetSnmpClient\SimpleSnmpV2c;
use SurrealCristian\SnmpNetSnmpClient\TimeoutException;

$host = '127.0.0.1';
$community = 'private';
$timeout = 1000000; // microseconds
$retries = 3;

$snmp = new SimpleSnmpV2c();
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
} catch (Exception $e) {
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
} catch (Exception $e) {
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
} catch (Exception $e) {
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
} catch (Exception $e) {
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
} catch (Exception $e) {
    // handle exception
}
```

## License

MIT

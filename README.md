# selective/array-reader

A strictly typed array reader for PHP.

[![Latest Version on Packagist](https://img.shields.io/github/release/selective-php/array-reader.svg)](https://packagist.org/packages/selective/array-reader)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://github.com/selective-php/array-reader/workflows/build/badge.svg)](https://github.com/selective-php/array-reader/actions)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/selective-php/array-reader.svg)](https://scrutinizer-ci.com/g/selective-php/array-reader/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/quality/g/selective-php/array-reader.svg)](https://scrutinizer-ci.com/g/selective-php/array-reader/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/selective/array-reader.svg)](https://packagist.org/packages/selective/array-reader/stats)


## Requirements

* PHP 8.1+

## Installation

```bash
composer require selective/array-reader
```

## Usage

You can use the `ArrayReader` to read single values from a multidimensional 
array by passing the path to one of the `get{type}()` and `find{type}()` methods. 

Each `get*() / find*()` method takes a default value as second argument.
If the path cannot be found in the original array, the default is used as return value.

A `get*()` method returns only the declared return type. 
If the default value is not given and the element cannot be found, an exception is thrown.

A `find*()` method returns only the declared return type or `null`. 
No exception is thrown if the element cannot be found.

```php
<?php

use Selective\ArrayReader\ArrayReader;

$arrayReader = new ArrayReader([
    'key1' => [
        'key2' => [
            'key3' => 'value1',
        ]
    ]
]);

// Output: value1
echo $arrayReader->getString('key1.key2.key3');
```

## Better Code Quality

Converting complex data with simple PHP works by using a lot of type casting and `if` conditions etc.
This leads to very high cyclomatic complexity and nesting depth, and thus poor "code rating".

**Before**: Conditions: 10, Paths: 512, CRAP Score: 10
<details>
  <summary>Click to expand!</summary>
<img src="https://user-images.githubusercontent.com/781074/109776592-096fcc80-7c03-11eb-95d4-6eef8fe982e2.png">
</details>

**After**: Conditions: 1, Paths: 1, CRAP Score: 1
<details>
  <summary>Click to expand!</summary>
<img src="https://user-images.githubusercontent.com/781074/109777526-1e992b00-7c04-11eb-8e6b-04d538661f4a.png">
</details>

## Similar libraries

* https://github.com/michaelpetri/typed-input
* https://github.com/codeliner/array-reader
* https://github.com/adbario/php-dot-notation
* https://symfony.com/doc/current/components/property_access.html

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

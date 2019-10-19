<?php

namespace Selective\ArrayReader\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Selective\ArrayReader\ArrayReader;

/**
 * Test.
 */
class ArrayReaderTest extends TestCase
{
    /**
     * Test.
     *
     * @dataProvider providerGetString
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testGetString($data, string $key, $default, $expected)
    {
        $reader = new ArrayReader($data);
        static::assertSame($expected, $reader->findString($key, $default));
        static::assertSame($expected, $reader->getString($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetString(): array
    {
        return [
            [['key' => 'value'], 'key', null, 'value'],
            [['key' => null], 'key', 'value', 'value'],
            [['key' => 'value'], 'nope', 'default', 'default'],
            [['key' => ['key2' => 'value']], 'key.key2', null, 'value'],
            [['key' => ['key2' => 'value']], 'key.nope', 'default', 'default'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerGetStringError
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    public function testGetStringError($data, string $key)
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new ArrayReader($data);
        $reader->getString($key);

        static::assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerGetStringError(): array
    {
        return [
            [['key' => 'value'], 'nope'],
            [['key' => null], 'nope'],
            [['key' => ['key2' => 'value']], 'key.nope'],
            [['key' => ['key2' => null]], 'key.key2'],
        ];
    }

    /**
     * Test.
     *
     * @dataProvider providerFindString
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    public function testFindString($data, string $key, $default, $expected)
    {
        $reader = new ArrayReader($data);
        static::assertSame($expected, $reader->findString($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public function providerFindString(): array
    {
        return [
            [['key' => 'value'], 'key', null, 'value'],
            [['key' => null], 'key', 'value', 'value'],
            [['key' => null], 'key', null, null],
            [['key' => 'value'], 'nope', 'default', 'default'],
            [['key' => ['key2' => 'value']], 'key.key2', null, 'value'],
            [['key' => ['key2' => 'value']], 'key.nope', 'default', 'default'],
        ];
    }
}

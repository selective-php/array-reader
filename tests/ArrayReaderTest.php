<?php

namespace Selective\ArrayReader\Test;

use Cake\Chronos\Chronos;
use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
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
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerGetInt')]
    public function testCreateFromArray($data, $key, $default, $expected): void
    {
        $reader = ArrayReader::createFromArray($data);
        $this->assertSame($expected, $reader->getInt($key, $default));
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|key $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerGetInt')]
    public function testGetInt($data, $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->getInt($key, $default));
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     *
     * @return void
     */
    #[DataProvider('providerGetIntError')]
    public function testGetIntError($data, $key, $default): void
    {
        $reader = new ArrayReader($data);

        $this->expectException(InvalidArgumentException::class);

        $reader->getInt($key, $default);
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerFindInt')]
    public function testFindInt($data, $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->findInt($key, $default));
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|key $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerGetFloat')]
    public function testGetFloat($data, $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->getFloat($key, $default));
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     *
     * @return void
     */
    #[DataProvider('providerGetFloatError')]
    public function testGetFloatError($data, $key, $default): void
    {
        $reader = new ArrayReader($data);

        $this->expectException(InvalidArgumentException::class);

        $reader->getFloat($key, $default);
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerFindFloat')]
    public function testFindFloat($data, $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->findFloat($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetInt(): array
    {
        return [
            [[0, 1, 2, 3], 0, null, 0],
            [[0, 1, 2, 3], 1, null, 1],
            [[0, 1, 2, 3], 2, null, 2],
            [[0, 1, 2, 3], 3, null, 3],
        ];
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetIntError(): array
    {
        return [
            [[0, 1, 2, 3], 4, null],
            [[0, 1, 2, 3, null], 4, null],
            [[0, 1, 2, null, 4], 3, null],
        ];
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerFindInt(): array
    {
        return [
            [[0, 1, 2, 3], 0, null, 0],
            [[0, 1, 2, 3], 1, null, 1],
            [[0, 1, 2, 3], 2, null, 2],
            [[0, 1, 2, 3], 3, null, 3],
            [[0, 1, 2, 3], 4, null, null],
            [[0, 1, 2, 3, null], 4, null, null],
            [[0, 1, 2, null, 4], 3, null, null],
        ];
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetFloat(): array
    {
        return [
            [[0.1, 1.2, 2.3, 3.4], 0, null, 0.1],
            [[0.1, 1.2, 2.3, 3.4], 1, null, 1.2],
            [[0.1, 1.2, 2.3, 3.4], 2, null, 2.3],
            [[0.1, 1.2, 2.3, 3.4], 3, null, 3.4],
        ];
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetFloatError(): array
    {
        return [
            [[0.1, 1.2, 2.3, 3.4], 4, null],
            [[0.1, 1.2, 2.3, 3.4, null], 4, null],
            [[0.1, 1.2, 2.3, null, 4.4], 3, null],
        ];
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerFindFloat(): array
    {
        return [
            [[0.1, 1.2, 2.3, 3.4], 0, null, 0.1],
            [[0.1, 1.2, 2.3, 3.4], 1, null, 1.2],
            [[0.1, 1.2, 2.3, 3.4], 2, null, 2.3],
            [[0.1, 1.2, 2.3, 3.4], 3, null, 3.4],
            [[0.1, 1.2, 2.3, 3.4], 4, null, null],
            [[0.1, 1.2, 2.3, 3.4, null], 4, null, null],
            [[0.1, 1.2, 2.3, null, 4.4], 3, null, null],
        ];
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerGetString')]
    public function testGetString($data, string $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->findString($key, $default));
        $this->assertSame($expected, $reader->getString($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetString(): array
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
     * @param mixed $data The data
     * @param string $key The lookup key
     *
     * @return void
     */
    #[DataProvider('providerGetStringError')]
    public function testGetStringError($data, string $key): void
    {
        $this->expectException(InvalidArgumentException::class);

        $reader = new ArrayReader($data);
        $reader->getString($key);

        $this->assertTrue(true);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetStringError(): array
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
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerFindString')]
    public function testFindString($data, string $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->findString($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerFindString(): array
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

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerGetArray')]
    public function testGetArray($data, $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->getArray($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetArray(): array
    {
        return [
            [[[1, 2, 3, 4], [2, 3, 4, 5, 6]], 0, null, [1, 2, 3, 4]],
            [[[1, 2, 3, 4], [2, 3, 4, 5, 6]], 1, null, [2, 3, 4, 5, 6]],
            [[['key' => 'value'], ['key2' => 'value2']], 0, null, ['key' => 'value']],
            [[['key' => 'value'], ['key2' => 'value2']], 1, null, ['key2' => 'value2']],
        ];
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     *
     * @return void
     */
    #[DataProvider('providerGetArrayError')]
    public function testGetArrayError($data, $key, $default): void
    {
        $reader = new ArrayReader($data);

        $this->expectException(InvalidArgumentException::class);

        $reader->getArray($key, $default);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetArrayError(): array
    {
        return [
            [[[1, 2, 3, 4], [2, 3, 4, 5, 6]], 2, null],
            [[['key' => 'value'], ['key2' => 'value2']], 2, null],
        ];
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string|int $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerFindArray')]
    public function testFindArray($data, $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);
        $this->assertSame($expected, $reader->findArray($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerFindArray(): array
    {
        return [
            [[[1, 2, 3, 4], [2, 3, 4, 5, 6]], 0, null, [1, 2, 3, 4]],
            [[[1, 2, 3, 4], [2, 3, 4, 5, 6]], 1, null, [2, 3, 4, 5, 6]],
            [[[1, 2, 3, 4], [2, 3, 4, 5, 6]], 2, [], []],
            [[[1, 2, 3, 4], [2, 3, 4, 5, 6]], 2, null, null],
            [[['key' => 'value'], ['key2' => 'value2']], 0, null, ['key' => 'value']],
            [[['key' => 'value'], ['key2' => 'value2']], 1, null, ['key2' => 'value2']],
            [[['key' => 'value'], ['key2' => 'value2']], 2, null, null],
        ];
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerGetDateTime')]
    public function testGetDateTime($data, string $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);

        $this->assertEquals($expected, $reader->findDateTime($key, $default));
        $this->assertEquals($expected, $reader->getDateTime($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetDateTime(): array
    {
        $date = new DateTimeImmutable('2020-01-02T03:04:05+00:00');
        $fraction = new DateTimeImmutable('2020-01-02T03:04:05.500000+00:00');
        $chronos = new Chronos('2020-01-02T03:04:05+00:00');

        return [
            [['created' => '2020-01-02T03:04:05+00:00'], 'created', null, $date],
            [['created' => $date], 'created', null, $date],
            [['created' => new DateTime('2020-01-02T03:04:05+00:00')], 'created', null, $date],
            [['created' => 1577934245], 'created', null, $date],
            [['created' => 1577934245.5], 'created', null, $fraction],
            [['user' => ['created' => '2020-01-02T03:04:05+00:00']], 'user.created', null, $date],
            [['created' => $chronos], 'created', null, $chronos],
            [[], 'missing', $date, $date],
            [['created' => null], 'created', $date, $date],
        ];
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     *
     * @return void
     */
    #[DataProvider('providerGetDateTimeError')]
    public function testGetDateTimeError($data, string $key, $default): void
    {
        $reader = new ArrayReader($data);

        $this->expectException(InvalidArgumentException::class);

        $reader->getDateTime($key, $default);
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerGetDateTimeError(): array
    {
        return [
            [['created' => null], 'created', null],
            [['created' => ''], 'created', null],
            [[], 'missing', null],
            [['created' => ['not-a-date']], 'created', null],
            [['created' => INF], 'created', null],
            [['created' => NAN], 'created', null],
            [['user' => ['created' => null]], 'user.created', null],
        ];
    }

    /**
     * Test.
     *
     * @param mixed $data The data
     * @param string $key The lookup key
     * @param mixed $default The default value
     * @param mixed $expected The expected value
     *
     * @return void
     */
    #[DataProvider('providerFindDateTime')]
    public function testFindDateTime($data, string $key, $default, $expected): void
    {
        $reader = new ArrayReader($data);

        $this->assertEquals($expected, $reader->findDateTime($key, $default));
    }

    /**
     * Provider.
     *
     * @return array[] The test data
     */
    public static function providerFindDateTime(): array
    {
        $date = new DateTimeImmutable('2020-01-02T03:04:05+00:00');

        return [
            [['created' => '2020-01-02T03:04:05+00:00'], 'created', null, $date],
            [['created' => null], 'created', null, null],
            [['created' => ''], 'created', null, null],
            [['created' => ''], 'created', $date, null],
            [[], 'missing', null, null],
            [[], 'missing', $date, $date],
            [['created' => null], 'created', $date, $date],
            [['user' => ['created' => '2020-01-02T03:04:05+00:00']], 'user.created', null, $date],
            [['user' => ['created' => null]], 'user.created', null, null],
        ];
    }
}

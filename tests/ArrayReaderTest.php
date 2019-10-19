<?php

namespace Selective\Artifact\Test;

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
     * @return void
     */
    public function testGetString()
    {
        $reader = new ArrayReader(['key' => 'value']);
        static::assertSame('value', $reader->getString('key'));
    }
}

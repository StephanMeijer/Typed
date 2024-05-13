<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\StrictString;

#[CoversClass(StrictString::class)]
#[CoversClass(InvalidTypeException::class)]
class StrictStringTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testEnforce(): void
    {
        $this->assertSame("Hello there", StrictString::enforce("Hello there"));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'string'));

        StrictString::enforce(12345);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullable(): void
    {
        $this->assertNull(StrictString::enforceNullable(null));
        $this->assertSame("Hello there", StrictString::enforce("Hello there"));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('int', 'null|string'));

        StrictString::enforceNullable(1234);
    }
}

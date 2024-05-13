<?php

declare(strict_types=1);

namespace Tests\StephanMeijer\Typed;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use StephanMeijer\Typed\Exception\InvalidTypeException;
use StephanMeijer\Typed\StrictInt;

#[CoversClass(StrictInt::class)]
#[CoversClass(InvalidTypeException::class)]
class StrictIntTest extends TestCase
{
    /**
     * @throws InvalidTypeException
     */
    public function testEnforce(): void
    {
        $this->assertSame(3, StrictInt::enforce(3));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('double', 'int'));

        StrictInt::enforce(12345.3);
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullable(): void
    {
        $this->assertNull(StrictInt::enforceNullable(null));
        $this->assertSame(3, StrictInt::enforce(3));
    }

    /**
     * @throws InvalidTypeException
     */
    public function testEnforceNullableThrows(): void
    {
        $this->expectExceptionObject(new InvalidTypeException('string', 'null|int'));

        StrictInt::enforceNullable("x");
    }
}

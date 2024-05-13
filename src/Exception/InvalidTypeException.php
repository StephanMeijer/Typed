<?php

declare(strict_types=1);

namespace StephanMeijer\Typed\Exception;

use StephanMeijer\Typed\TypedString;

class InvalidTypeException extends \Exception
{
    public function __construct(string $actual, string $expected)
    {
        parent::__construct("Expected type {$expected}, but got {$actual}");
    }

    public static function fromValue(mixed $value, string $expected): self
    {
        return new self(self::actualType($value), $expected);
    }

    protected static function actualType(mixed $value): string
    {
        if (is_object($value)) {
            return get_class($value);
        }

        return gettype($value);
    }
}

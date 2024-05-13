<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class StrictString
{
    /**
     * @psalm-assert string $value
     *
     * @throws InvalidTypeException
     */
    public static function enforce(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'string');
    }

    /**
     * @psalm-assert null|string $value
     *
     * @throws InvalidTypeException
     */
    public static function enforceNullable(mixed $value): ?string
    {
        if ($value === null || is_string($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|string');
    }
}

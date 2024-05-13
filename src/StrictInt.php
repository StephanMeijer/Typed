<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class StrictInt
{
    /**
     * @psalm-assert int $value
     *
     * @throws InvalidTypeException
     */
    public static function enforce(mixed $value): int
    {
        if (is_int($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'int');
    }

    /**
     * @psalm-assert null|int $value
     *
     * @throws InvalidTypeException
     */
    public static function enforceNullable(mixed $value): ?int
    {
        if ($value === null || is_int($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|int');
    }
}

<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class TypedString
{
    /**
     * @throws InvalidTypeException
     */
    public static function cast(mixed $value): string
    {
        if (is_string($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'string');
    }

    /**
     * @throws InvalidTypeException
     */
    public static function castNullable(mixed $value): ?string
    {
        if ($value === null || is_string($value)) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|string');
    }
}

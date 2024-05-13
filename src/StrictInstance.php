<?php

declare(strict_types=1);

namespace StephanMeijer\Typed;

use StephanMeijer\Typed\Exception\InvalidTypeException;

class StrictInstance
{
    /**
     * @template T of object
     *
     * @param mixed $value
     * @param class-string<T> $className
     * @return object
     *
     * @throws InvalidTypeException
     */
    public static function enforce(mixed $value, string $className): object
    {
        if (is_object($value) && get_class($value) === $className) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, $className);
    }

    /**
     * @template T of object
     *
     * @param mixed $value
     * @param class-string<T> $className
     * @return ?object
     *
     * @throws InvalidTypeException
     */
    public static function enforceNullable(mixed $value, string $className): ?object
    {
        if ($value === null) {
            return null;
        }

        if (is_object($value) && get_class($value) === $className) {
            return $value;
        }

        throw InvalidTypeException::fromValue($value, 'null|' . $className);
    }
}
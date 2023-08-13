<?php

namespace Majorov\AtolOnlineSdk\Model;

use BackedEnum;
use DateTimeImmutable;
use InvalidArgumentException;
use ReflectionObject;
use ReflectionProperty;

abstract class RequestPart
{
    public function toArray(): array
    {
        $reflection = new ReflectionObject($this);
        $result = [];
        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $output = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $property->getName()));
            $result[$output] = $this->serializeValue($this->{$property->getName()});
        }

        return $result;
    }

    private function serializeValue(mixed $value): mixed
    {
        if (is_scalar($value) || $value === null) {
            return $value;
        }

        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        if ($value instanceof DateTimeImmutable) {
            return $value->format('d.m.Y');
        }

        if (is_array($value)) {
            return array_map([$this, 'serializeValue'], $value);
        }

        if ($value instanceof RequestPart) {
            return $value->toArray();
        }

        throw new InvalidArgumentException('Unsupported type: ' . gettype($value));
    }
}

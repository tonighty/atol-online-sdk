<?php

namespace Majorov\AtolOnlineSdk\Model;

final class AdditionalUserProps extends RequestPart
{
    public function __construct(
        public readonly string $name,
        public readonly string $value,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}

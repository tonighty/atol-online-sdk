<?php

namespace Majorov\AtolOnlineSdk\Model;

use InvalidArgumentException;

final class Client extends RequestPart
{
    public function __construct(
        public readonly ?string $email,
        public readonly ?string $phone,
        public readonly ?string $name = null,
        public readonly ?string $inn = null,
    )
    {
        if ($this->email === null && $this->phone === null) {
            throw new InvalidArgumentException('Either email or phone required');
        }
    }
}

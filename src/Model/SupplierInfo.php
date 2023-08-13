<?php

namespace Majorov\AtolOnlineSdk\Model;

final class SupplierInfo extends RequestPart
{
    public function __construct(
        public readonly array  $phones,
        public readonly string $name,
        public readonly string $inn,
    )
    {
    }
}

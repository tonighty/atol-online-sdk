<?php

namespace Majorov\AtolOnlineSdk\Model;

final class MoneyTransferOperator extends RequestPart
{
    public function __construct(
        public readonly ?array  $phones,
        public readonly ?string $name,
        public readonly ?string $address,
        public readonly ?string $inn,
    )
    {
    }
}

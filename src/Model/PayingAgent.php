<?php

namespace Majorov\AtolOnlineSdk\Model;

final class PayingAgent extends RequestPart
{
    public function __construct(
        public readonly string $operation,
        public readonly array  $phones,
    )
    {
    }
}

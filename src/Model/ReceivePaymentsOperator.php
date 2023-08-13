<?php

namespace Majorov\AtolOnlineSdk\Model;

final class ReceivePaymentsOperator extends RequestPart
{
    public function __construct(
        public readonly array $phones,
    )
    {
    }
}

<?php

namespace Majorov\AtolOnlineSdk\Model;

use Majorov\AtolOnlineSdk\Enum\PaymentType;

final class Payment extends RequestPart
{
    public function __construct(
        public readonly PaymentType $type,
        public readonly ?float      $sum = null,
    )
    {
    }
}

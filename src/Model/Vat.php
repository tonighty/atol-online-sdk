<?php

namespace Majorov\AtolOnlineSdk\Model;

use Majorov\AtolOnlineSdk\Enum\VatType;

final class Vat extends RequestPart
{
    public function __construct(
        public readonly VatType $type,
        public readonly ?float  $sum,
    )
    {
    }
}

<?php

namespace Majorov\AtolOnlineSdk\Model;


use Majorov\AtolOnlineSdk\Enum\Sno;

final class Company extends RequestPart
{
    public function __construct(
        public readonly string  $email,
        public readonly Sno     $sno,
        public readonly string  $inn,
        public readonly string  $paymentAddress,
        public readonly ?string $location = null,
    )
    {
    }
}

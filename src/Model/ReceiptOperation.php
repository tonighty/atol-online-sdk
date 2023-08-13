<?php

namespace Majorov\AtolOnlineSdk\Model;

use DateTimeImmutable;

final class ReceiptOperation extends RequestPart
{
    public function __construct(
        public readonly string            $externalId,
        public readonly Receipt           $receipt,
        public readonly ?Service          $service,
        public readonly DateTimeImmutable $timestamp,
    )
    {
    }
}

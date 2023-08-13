<?php

namespace Majorov\AtolOnlineSdk\Model;

use DateTimeImmutable;
use Majorov\AtolOnlineSdk\Enum\OperationStatus;

final class OperationResponse extends ResponsePart
{
    public function __construct(
        public readonly string            $uuid,
        public readonly DateTimeImmutable $timestamp,
        public readonly OperationStatus   $status,
    )
    {
    }

    static function fromArray(array $data): OperationResponse
    {
        return new self(
            $data['uuid'],
            new DateTimeImmutable($data['timestamp']),
            OperationStatus::from($data['status']),
        );
    }
}

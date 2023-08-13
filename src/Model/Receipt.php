<?php

namespace Majorov\AtolOnlineSdk\Model;

final class Receipt extends RequestPart
{
    public function __construct(
        public readonly Client               $client,
        public readonly Company              $company,
        public readonly array                $items,
        public readonly array                $vats,
        public readonly array                $payments,
        public readonly float                $total,
        public readonly ?AgentInfo           $agentInfo = null,
        public readonly ?SupplierInfo        $supplierInfo = null,
        public readonly ?string              $additionalCheckProps = null,
        public readonly ?string              $cashier = null,
        public readonly ?AdditionalUserProps $additionalUserProps = null,
        public readonly ?string              $deviceNumber = null,
    )
    {
    }
}

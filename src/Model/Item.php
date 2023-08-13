<?php

namespace Majorov\AtolOnlineSdk\Model;


use Majorov\AtolOnlineSdk\Enum\PaymentMethod;
use Majorov\AtolOnlineSdk\Enum\PaymentObject;

final class Item extends RequestPart
{
    public function __construct(
        public readonly string        $name,
        public readonly float         $price,
        public readonly float         $quantity,
        public readonly float         $sum,
        public readonly PaymentMethod $paymentMethod,
        public readonly PaymentObject $paymentObject,
        public readonly Vat           $vat,
        public readonly ?string       $nomenclatureCode = null,
        public readonly ?string       $measurementUnit = null,
        public readonly ?AgentInfo    $agentInfo = null,
        public readonly ?SupplierInfo $supplierInfo = null,
        public readonly ?string       $userData = null,
        public readonly ?float        $excise = null,
        public readonly ?string       $countryCode = null,
        public readonly ?string       $declarationNumber = null,
    )
    {
    }
}

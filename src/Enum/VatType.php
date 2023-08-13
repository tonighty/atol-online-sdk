<?php

namespace Majorov\AtolOnlineSdk\Enum;

enum VatType: string
{
    case None = 'none';
    case Vat0 = 'vat0';
    case Vat10 = 'vat10';
    case Vat18 = 'vat18';
    case Vat110 = 'vat110';
    case Vat118 = 'vat118';
    case Vat20 = 'vat20';
    case Vat120 = 'vat120';
}

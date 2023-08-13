<?php

namespace Majorov\AtolOnlineSdk\Enum;

enum PaymentMethod: string
{
    case FullPrepayment = 'full_prepayment';
    case Prepayment = 'prepayment';
    case Advance = 'advance';
    case FullPayment = 'full_payment';
    case PartialPayment = 'partial_payment';
    case Credit = 'credit';
    case CreditPayment = 'credit_payment';
}

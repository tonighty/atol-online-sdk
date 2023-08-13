<?php

namespace Majorov\AtolOnlineSdk\Enum;

enum PaymentType: int
{
    case Cash = 0;
    case Cashless = 1;
    case Prepayment = 2;
    case Credit = 3;
    case Another = 4;
}

<?php

namespace Majorov\AtolOnlineSdk\Enum;

enum OperationErrorType: string
{
    case System = 'system';
    case Driver = 'driver';
    case Timeout = 'timeout';
    case Unknown = 'unknown';
}

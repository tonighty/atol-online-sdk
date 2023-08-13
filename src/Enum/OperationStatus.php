<?php

namespace Majorov\AtolOnlineSdk\Enum;

enum OperationStatus: string
{
    case Wait = 'wait';
    case Fail = 'fail';
    case Done = 'done';
}

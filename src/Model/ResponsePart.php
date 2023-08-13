<?php

namespace Majorov\AtolOnlineSdk\Model;

abstract class ResponsePart
{
    abstract static function fromArray(array $data): self;
}
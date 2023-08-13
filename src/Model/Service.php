<?php

namespace Majorov\AtolOnlineSdk\Model;

final class Service extends RequestPart
{
    public function __construct(
        public readonly ?string $callbackUrl
    )
    {
    }
}

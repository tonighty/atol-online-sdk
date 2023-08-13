<?php

namespace Majorov\AtolOnlineSdk\Model;


use Majorov\AtolOnlineSdk\Enum\AgentType;

final class AgentInfo extends RequestPart
{
    public function __construct(
        public readonly AgentType                $type,
        public readonly ?PayingAgent             $payingAgent,
        public readonly ?ReceivePaymentsOperator $receivePaymentsOperator,
        public readonly ?MoneyTransferOperator   $moneyTransferOperator,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type->value,
        ];
    }
}

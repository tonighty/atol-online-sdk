<?php

namespace Majorov\AtolOnlineSdk\Enum;

enum PaymentObject: string
{
    case Commodity = 'commodity';
    case Excise = 'excise';
    case Job = 'job';
    case Service = 'service';
    case GamblingBet = 'gambling_bet';
    case GamblingPrize = 'gambling_prize';
    case Lottery = 'lottery';
    case LotteryPrize = 'lottery_prize';
    case IntellectualActivity = 'intellectual_activity';
    case Payment = 'payment';
    case AgentCommission = 'agent_commission';
    case Composite = 'composite';
    case Award = 'award';
    case Another = 'another';
    case PropertyRight = 'property_right';
    case NonOperationGain = 'non-operating_gain';
    case InsurancePremium = 'insurance_premium';
    case SalesTax = 'sales_tax';
    case ResortFee = 'resort_fee';
    case Deposit = 'deposit';
    case Expense = 'expense';
}

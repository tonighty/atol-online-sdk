<?php

namespace Majorov\Tests\AtolOnlineSdk;

use DateTimeImmutable;
use GuzzleHttp\Psr7\HttpFactory;
use Majorov\AtolOnlineSdk\ApiClient;
use Majorov\AtolOnlineSdk\Enum\PaymentMethod;
use Majorov\AtolOnlineSdk\Enum\PaymentObject;
use Majorov\AtolOnlineSdk\Enum\PaymentType;
use Majorov\AtolOnlineSdk\Enum\Sno;
use Majorov\AtolOnlineSdk\Enum\VatType;
use Majorov\AtolOnlineSdk\Model\Client;
use Majorov\AtolOnlineSdk\Model\Company;
use Majorov\AtolOnlineSdk\Model\Item;
use Majorov\AtolOnlineSdk\Model\Payment;
use Majorov\AtolOnlineSdk\Model\Receipt;
use Majorov\AtolOnlineSdk\Model\ReceiptOperation;
use Majorov\AtolOnlineSdk\Model\Service;
use Majorov\AtolOnlineSdk\Model\Vat;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    public function testClient(): void
    {
        $client = new ApiClient(
            'loging',
            'pass',
            'group',
            true,
            new \GuzzleHttp\Client(),
            new HttpFactory(),
            new HttpFactory(),
        );

        $operation = new ReceiptOperation(
            'qweqwe',
            new Receipt(
                new Client('root@majorov.xyz', null),
                new Company('rich@majorov.xyz', Sno::Osn, '5544332219', 'http://example.com'),
                [new Item(
                    'Название',
                    100,
                    2,
                    200,
                    PaymentMethod::FullPrepayment,
                    PaymentObject::Commodity,
                    new Vat(VatType::Vat0, 0),
                )],
                [new Vat(VatType::Vat0, 0)],
                [new Payment(PaymentType::Cash, 200)],
                200,
            ),
            new Service('https://majorov.xyz'),
            new DateTimeImmutable(),
        );

        $response = $client->sell($operation);

        $this->assertInstanceOf(Receipt::class, $response->timestamp);

    }
}
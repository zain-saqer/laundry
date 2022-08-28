<?php

namespace App\Tests\Functional\Controller\Order;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @internal
 * @coversNothing
 */
class NewOrderControllerTest extends WebTestCase
{
    public function testNewOrderReturns200ForGoodRequest(): void
    {
        $client = static::createClient();

        $client->request('POST', '/orders/v1/order', content: '
{
    "comment": "comment",
    "pickupDate": 0
}
');

        $this->assertResponseIsSuccessful();
    }

    /**
     * @dataProvider badRequestContentProvider
     */
    public function testNewOrderReturnsBadRequestIfDataBad(string $content, int $response): void
    {
        $client = static::createClient();

        $client->request('POST', '/orders/v1/order', content: $content);

        $this->assertResponseStatusCodeSame(400);
    }

    public function badRequestContentProvider(): array
    {
        return [
            [
                '',
                400,
            ],
            [
                '{',
                400,
            ],
            [
                '{}',
                422,
            ],
            [
                '{"comment":""}',
                422,
            ],
        ];
    }
}

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

        $client->request('GET', '/orders/new-order');

        $this->assertResponseIsSuccessful();

        $client->submitForm('Create', [
            'new_order_from[numberOfLoads]' => 1,
            'new_order_from[pickupDate][month]' => 1,
            'new_order_from[pickupDate][day]' => 1,
            'new_order_from[pickupDate][year]' => 2017,
            'new_order_from[timeOfDay]' => '9-12',
        ]);

        $this->assertResponseStatusCodeSame(302);
    }

    /**
     * @dataProvider badFormData
     */
    public function testNewOrderThrowInvalidArgumnetForBadRequestData($formData): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $client = static::createClient();

        $client->request('GET', '/orders/new-order');

        $this->assertResponseIsSuccessful();

        $client->submitForm('Create', $formData);
    }

    public function badFormData(): array
    {
        return [
            [
                [
                    'new_order_from[numberOfLoads]' => 0,
                    'new_order_from[pickupDate][month]' => 1,
                    'new_order_from[pickupDate][day]' => 1,
                    'new_order_from[pickupDate][year]' => 2022,
                    'new_order_from[timeOfDay]' => '9-162',
                ],
            ],
            [
                [
                    'new_order_from[numberOfLoads]' => 1,
                    'new_order_from[pickupDate][month]' => 1,
                    'new_order_from[pickupDate][day]' => 1,
                    'new_order_from[pickupDate][year]' => 123,
                    'new_order_from[timeOfDay]' => '9-162',
                ],
            ],
            [
                [
                    'new_order_from[numberOfLoads]' => 1,
                    'new_order_from[pickupDate][month]' => 1,
                    'new_order_from[pickupDate][day]' => 1,
                    'new_order_from[pickupDate][year]' => 2022,
                    'new_order_from[timeOfDay]' => '9',
                ],
            ],
        ];
    }
}

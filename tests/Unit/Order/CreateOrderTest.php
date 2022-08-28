<?php

namespace App\Tests\Unit\Order;

use App\Laundry\Order\CreateOrder;
use App\Laundry\Order\Entity\Order;
use App\Laundry\Order\Model\Comment;
use App\Laundry\Order\Model\CreateOrderRequest;
use App\Laundry\Order\Model\NumberOfLoads;
use App\Laundry\Order\Model\OrderId;
use App\Laundry\Order\Model\PickupDate;
use App\Laundry\Order\Model\TimeOfDay;
use App\Laundry\Order\Storage\OrderRepositoryInterface;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 * @coversNothing
 */
class CreateOrderTest extends TestCase
{
    public function testInvoke(): void
    {
        $orderId = OrderId::fromUuid(Uuid::uuid4());
        $comment = '';
        $pickupDate = new DateTimeImmutable();
        $timeOfDate = TimeOfDay::T_9_TO_12;
        $numberOfLoads = 1;

        $expectedOrder = new Order(
            id: $orderId,
            numberOfLoads: NumberOfLoads::fromInt($numberOfLoads),
            pickupDate: PickupDate::fromDateTime($pickupDate),
            timeOfDay: TimeOfDay::fromString($timeOfDate),
            comment: Comment::fromString($comment),
        );

        $orderRepository = $this->createMock(OrderRepositoryInterface::class);
        $orderRepository
            ->expects(static::once())
            ->method('nextId')
            ->willReturn($orderId)
        ;
        $orderRepository
            ->expects(static::once())
            ->method('save')
            ->willReturnCallback(function (Order $order) use ($expectedOrder) {
                self::assertEquals($order, $expectedOrder);
            })
        ;

        $createOrder = new CreateOrder($orderRepository);

        $createOrder(new CreateOrderRequest(
            numberOfLoads: $numberOfLoads,
            pickupDate: $pickupDate,
            timeOfDay: $timeOfDate,
            comment: $comment,
        ));
    }
}

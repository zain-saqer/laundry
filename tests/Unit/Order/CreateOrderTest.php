<?php

namespace App\Tests\Unit\Order;

use App\Laundry\Order\CreateOrder;
use App\Laundry\Order\Entity\Order;
use App\Laundry\Order\Model\Comment;
use App\Laundry\Order\Model\CreateOrderRequest;
use App\Laundry\Order\Model\OrderId;
use App\Laundry\Order\Model\PickupDate;
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
        $expectedOrder = new Order(
            $orderId,
            Comment::fromString($comment),
            PickupDate::fromDateTime($pickupDate),
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

        $createOrder(new CreateOrderRequest($comment, $pickupDate));
    }
}

<?php

namespace App\Tests\Unit\Order\Storage;

use App\Laundry\Order\Entity\Order;
use App\Laundry\Order\Model\Comment;
use App\Laundry\Order\Model\NumberOfLoads;
use App\Laundry\Order\Model\OrderId;
use App\Laundry\Order\Model\PickupDate;
use App\Laundry\Order\Model\TimeOfDay;
use App\Laundry\Order\OrderRepositoryUsingMemory;
use App\Laundry\Order\Storage\OrderNotFoundException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 * @coversNothing
 */
class OrderRepositoryUsingMemoryTest extends TestCase
{
    public function testSaveAndFind(): void
    {
        $id = OrderId::fromUuid(UUid::uuid4());
        $comment = Comment::fromString('comment');
        $pickupDate = PickupDate::fromDateTime(new \DateTimeImmutable());
        $numberOfDays = NumberOfLoads::fromInt(1);
        $timeOfDay = TimeOfDay::fromString(TimeOfDay::T_9_TO_12);

        $order = new Order(
            id: $id,
            numberOfLoads: $numberOfDays,
            pickupDate: $pickupDate,
            timeOfDay: $timeOfDay,
            comment: $comment,
        );

        $repo = new OrderRepositoryUsingMemory();

        $repo->save($order);

        $orderViewModel = $repo->find($id);

        static::assertEquals(
            new \App\Laundry\Order\Model\Order(
                orderId: $id,
                numberOfLoads: $numberOfDays,
                pickupDate: $pickupDate,
                timeOfDay: $timeOfDay,
                comment: $comment,
            ),
            $orderViewModel
        );
    }

    public function testFindThrowsExceptionIfOrderNotFound(): void
    {
        $this->expectException(OrderNotFoundException::class);

        $repo = new OrderRepositoryUsingMemory();

        $repo->find(OrderId::fromUuid(Uuid::uuid4()));
    }

    public function testNextId(): void
    {
        $orderRepository = new OrderRepositoryUsingMemory();

        static::assertNotSame($orderRepository->nextId(), $orderRepository->nextId());
    }
}

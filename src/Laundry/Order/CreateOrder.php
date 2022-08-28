<?php

namespace App\Laundry\Order;

use App\Laundry\Order\Entity\Order;
use App\Laundry\Order\Model\Comment;
use App\Laundry\Order\Model\CreateOrderRequest;
use App\Laundry\Order\Model\NumberOfLoads;
use App\Laundry\Order\Model\PickupDate;
use App\Laundry\Order\Model\TimeOfDay;
use App\Laundry\Order\Storage\OrderRepositoryInterface;

class CreateOrder implements CreateOrderInterface
{
    public function __construct(
        private readonly OrderRepositoryInterface $orderRepository,
    ) {
    }

    public function __invoke(CreateOrderRequest $createOrderRequest): void
    {
        $order = new Order(
            id: $this->orderRepository->nextId(),
            numberOfLoads: NumberOfLoads::fromInt($createOrderRequest->numberOfLoads),
            pickupDate: PickupDate::fromDateTime($createOrderRequest->pickupDate),
            timeOfDay: TimeOfDay::fromString($createOrderRequest->timeOfDay),
            comment: Comment::fromString($createOrderRequest->comment)
        );

        $this->orderRepository->save($order);
    }
}

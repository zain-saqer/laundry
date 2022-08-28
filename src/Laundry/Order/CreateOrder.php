<?php

namespace App\Laundry\Order;

use App\Laundry\Order\Entity\Order;
use App\Laundry\Order\Model\Comment;
use App\Laundry\Order\Model\CreateOrderRequest;
use App\Laundry\Order\Model\PickupDate;
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
            $this->orderRepository->nextId(),
            Comment::fromString($createOrderRequest->comment),
            PickupDate::fromDateTime($createOrderRequest->pickupDate),
        );

        $this->orderRepository->save($order);
    }
}

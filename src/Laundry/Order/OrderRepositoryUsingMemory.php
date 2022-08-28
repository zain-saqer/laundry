<?php

namespace App\Laundry\Order;

use App\Laundry\Order\Entity\Order;
use App\Laundry\Order\Model\OrderId;
use App\Laundry\Order\Storage\OrderNotFoundException;
use App\Laundry\Order\Storage\OrderRepositoryInterface;
use Ramsey\Uuid\Uuid;

class OrderRepositoryUsingMemory implements OrderRepositoryInterface
{
    /**
     * @var array<string, array>
     */
    private array $orders = [];

    public function save(Order $order): void
    {
        $this->orders[$order->getId()->toString()] = $order->mappedData();
    }

    public function find(OrderId $orderId): Model\Order
    {
        if (!\array_key_exists($orderId->toString(), $this->orders)) {
            throw new OrderNotFoundException();
        }

        $orderData = $this->orders[$orderId->toString()];

        return new Model\Order(
            orderId: $orderData['id'],
            numberOfLoads: $orderData['number_of_loads'],
            pickupDate: $orderData['pickup_date'],
            timeOfDay: $orderData['time_of_day'],
            comment: $orderData['comment'],
        );
    }

    public function nextId(): OrderId
    {
        return OrderId::fromUuid(Uuid::uuid4());
    }
}

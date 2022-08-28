<?php

namespace App\Laundry\Order\Model;

class Order
{
    public function __construct(
        public readonly OrderId $orderId,
        public readonly Comment $comment,
        public readonly PickupDate $pickupDate,
    ) {
    }
}

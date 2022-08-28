<?php

namespace App\Laundry\Order\Model;

class Order
{
    public function __construct(
        public readonly OrderId $orderId,
        public readonly NumberOfLoads $numberOfLoads,
        public readonly PickupDate $pickupDate,
        public readonly TimeOfDay $timeOfDay,
        public readonly Comment $comment,
    ) {
    }
}

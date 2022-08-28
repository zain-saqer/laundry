<?php

namespace App\Laundry\Order\Entity;

use App\Laundry\Order\Model\Comment;
use App\Laundry\Order\Model\OrderId;
use App\Laundry\Order\Model\PickupDate;

class Order
{
    public function __construct(
        private readonly OrderId $id,
        private readonly Comment $comment,
        private readonly PickupDate $pickupDate,
    ) {
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function mappedData(): array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'pickup_date' => $this->pickupDate,
        ];
    }
}

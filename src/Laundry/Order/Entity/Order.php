<?php

namespace App\Laundry\Order\Entity;

use App\Laundry\Order\Model\Comment;
use App\Laundry\Order\Model\NumberOfLoads;
use App\Laundry\Order\Model\OrderId;
use App\Laundry\Order\Model\PickupDate;
use App\Laundry\Order\Model\TimeOfDay;

class Order
{
    public function __construct(
        private readonly OrderId $id,
        private readonly NumberOfLoads $numberOfLoads,
        private readonly PickupDate $pickupDate,
        private readonly TimeOfDay $timeOfDay,
        private readonly Comment $comment,
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
            'number_of_loads' => $this->numberOfLoads,
            'time_of_day' => $this->timeOfDay,
            'pickup_date' => $this->pickupDate,
            'comment' => $this->comment,
        ];
    }
}

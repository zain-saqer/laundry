<?php

namespace App\Laundry\Order\Model;

use DateTimeImmutable;

class CreateOrderRequest
{
    public function __construct(
        public readonly int $numberOfLoads,
        public readonly DateTimeImmutable $pickupDate,
        public readonly string $timeOfDay,
        public readonly ?string $comment,
    ) {
    }
}

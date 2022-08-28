<?php

namespace App\Laundry\Order\Model;

use DateTimeImmutable;

class CreateOrderRequest
{
    public function __construct(
        public readonly string $comment,
        public readonly DateTimeImmutable $pickupDate,
    ) {
    }
}

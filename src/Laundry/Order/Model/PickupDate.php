<?php

namespace App\Laundry\Order\Model;

use DateTimeImmutable;

class PickupDate
{
    private function __construct(
        private readonly DateTimeImmutable $dateTime,
    ) {
    }

    public static function fromDateTime(DateTimeImmutable $dateTime): self
    {
        return new self($dateTime);
    }

    public function toDateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }
}

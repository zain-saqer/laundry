<?php

namespace App\Laundry\Order\Model;

use Ramsey\Uuid\UuidInterface;

class OrderId
{
    private function __construct(
        private readonly UuidInterface $uuid
    ) {
    }

    public static function fromUuid(UuidInterface $uuid): self
    {
        return new self($uuid);
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }
}

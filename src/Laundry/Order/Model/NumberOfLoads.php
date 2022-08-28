<?php

namespace App\Laundry\Order\Model;

class NumberOfLoads
{
    private function __construct(
        public readonly int $numOfLoads
    ) {
    }

    public function toInt(): int
    {
        return $this->numOfLoads;
    }

    public static function fromInt(int $numberOfLoads): self
    {
        return new self($numberOfLoads);
    }
}

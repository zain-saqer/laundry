<?php

namespace App\Laundry\Order\Model;

use Assert\Assertion;
use Assert\AssertionFailedException;

class TimeOfDay
{
    public const T_9_TO_12 = '9-12';
    public const T_12_TO_15 = '12-15';
    public const T_15_TO_18 = '15-18';
    public const T_18_TO_21 = '18-21';

    /**
     * @throws AssertionFailedException
     */
    private function __construct(
        private readonly string $timeOfDay,
    ) {
        Assertion::inArray($this->timeOfDay, [
            self::T_9_TO_12,
            self::T_12_TO_15,
            self::T_15_TO_18,
            self::T_18_TO_21,
        ]);
    }

    public function toString(): string
    {
        return $this->timeOfDay;
    }

    /**
     * @throws AssertionFailedException
     */
    public static function fromString(string $timeOfDay): self
    {
        return new self($timeOfDay);
    }
}

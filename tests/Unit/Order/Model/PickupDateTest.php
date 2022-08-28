<?php

namespace App\Tests\Unit\Order\Model;

use App\Laundry\Order\Model\PickupDate;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class PickupDateTest extends TestCase
{
    public function testPickupDate(): void
    {
        $date = new DateTimeImmutable();
        $pickupDate1 = PickupDate::fromDateTime($date);
        static::assertEquals($date, $pickupDate1->toDateTime());

        $pickupDate2 = PickupDate::fromDateTime($date);
        static::assertEquals($pickupDate1, $pickupDate2);

        $pickupDate3 = PickupDate::fromDateTime(new DateTimeImmutable());
        static::assertNotSame($pickupDate3, $pickupDate1);
    }
}

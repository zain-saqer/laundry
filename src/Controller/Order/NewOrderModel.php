<?php

namespace App\Controller\Order;

use App\Laundry\Order\Model\TimeOfDay;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

class NewOrderModel
{
    #[Assert\Length(min: 0, max: 500)]
    private ?string $comment = '';

    #[Assert\NotBlank]
    private DateTimeImmutable $pickupDate;

    #[Assert\NotBlank]
    #[Assert\Choice([TimeOfDay::T_9_TO_12, TimeOfDay::T_12_TO_15, TimeOfDay::T_15_TO_18, TimeOfDay::T_18_TO_21])]
    private string $timeOfDay;

    #[Assert\NotBlank]
    #[Assert\Range(min: 0, max: 5)]
    private string $numberOfLoads;

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

    public function getPickupDate(): DateTimeImmutable
    {
        return $this->pickupDate;
    }

    public function setPickupDate(DateTimeImmutable $pickupDate): void
    {
        $this->pickupDate = $pickupDate;
    }

    public function getTimeOfDay(): string
    {
        return $this->timeOfDay;
    }

    public function setTimeOfDay(string $timeOfDay): void
    {
        $this->timeOfDay = $timeOfDay;
    }

    public function getNumberOfLoads(): string
    {
        return $this->numberOfLoads;
    }

    public function setNumberOfLoads(string $numberOfLoads): void
    {
        $this->numberOfLoads = $numberOfLoads;
    }
}

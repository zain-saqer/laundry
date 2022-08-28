<?php

namespace App\Laundry\Order\Storage;

use App\Laundry\Order\Entity\Order;
use App\Laundry\Order\Model\Order as OrderViewModel;
use App\Laundry\Order\Model\OrderId;

interface OrderRepositoryInterface
{
    public function find(OrderId $orderId): OrderViewModel;

    public function nextId(): OrderId;

    public function save(Order $order): void;
}

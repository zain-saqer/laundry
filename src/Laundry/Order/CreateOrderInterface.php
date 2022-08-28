<?php

namespace App\Laundry\Order;

use App\Laundry\Order\Model\CreateOrderRequest;

interface CreateOrderInterface
{
    public function __invoke(CreateOrderRequest $createOrderRequest): void;
}

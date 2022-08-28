<?php

namespace App\Controller\Order;

use App\Laundry\Order\CreateOrderInterface;
use App\Laundry\Order\Model\CreateOrderRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class NewOrderController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly CreateOrderInterface $createOrder,
    ) {
    }

    #[Route('/orders/v1/order', name: 'orders_new_order_form', methods: ['POST'])]
    public function newOrderForm(Request $request): Response
    {
        try {
            $createOrderRequest = $this->serializer->deserialize(
                $request->getContent(),
                CreateOrderRequest::class,
                'json',
                [
                    DateTimeNormalizer::FORMAT_KEY => 'U',
                ]
            );
        } catch (UnexpectedValueException) {
            throw new BadRequestHttpException();
        } catch (RuntimeException) {
            throw new UnprocessableEntityHttpException();
        }

        ($this->createOrder)($createOrderRequest);

        return new Response();
    }
}

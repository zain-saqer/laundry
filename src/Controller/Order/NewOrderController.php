<?php

namespace App\Controller\Order;

use App\Laundry\Order\CreateOrderInterface;
use App\Laundry\Order\Model\CreateOrderRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewOrderController extends AbstractController
{
    public function __construct(
        private readonly CreateOrderInterface $createOrder,
    ) {
    }

    #[Route('/orders/new-order', name: 'orders_new_order_form')]
    public function newOrderForm(Request $request): Response
    {
        $newOrderModel = new NewOrderModel();

        $form = $this->createForm(NewOrderFromType::class, $newOrderModel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var NewOrderModel $newOrder */
            $newOrder = $form->getData();

            $createOrderRequest = new CreateOrderRequest(
                numberOfLoads: $newOrder->getNumberOfLoads(),
                pickupDate: $newOrder->getPickupDate(),
                timeOfDay: $newOrder->getTimeOfDay(),
                comment: $newOrder->getComment(),
            );

            ($this->createOrder)($createOrderRequest);

            $this->addFlash('orders:new_order_form', 'Added');

            return $this->redirectToRoute('orders_new_order_form');
        }

        return $this->renderForm('order/new_order/new_order.html.twig', [
            'form' => $form,
        ]);
    }
}

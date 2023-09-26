<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/order', name: 'app_order')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'index')]
    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to manage Order.')]
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([],['date' => 'ASC']);

        return $this->render('order/index.html.twig', [
            'controller_name' => 'Commandes récentes.',
            'orders' => $orders
        ]);
    }

    #[Route(null, name: 'app_order_create')]
    public function create(OrderRepository $orderRepository)
    {
        // $order = new Order();
        // $order->
    }
}

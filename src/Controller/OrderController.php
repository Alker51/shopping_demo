<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/order', name: 'app_order_')]
class OrderController extends AbstractController
{
    #[Route('/', name: 'index')]
    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to manage Order.')]
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([],['orderDate' => 'ASC']);

        return $this->render('order/index.html.twig', [
            'controller_name' => 'Commandes récentes.',
            'orders' => $orders
        ]);
    }

    #[Route('/create', name: 'create')]
    public function create(OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['id' => $_POST['user']]);
        var_dump($user->getUserIdentifier());
        $cart = (array)json_decode($_POST['cart']);
        var_dump($cart);
        exit;
        // @TODO Ajout du traitement pour créer la commande. Peut-être une redirection pour l'adresse etc apres.
        // $order = new Order();
        // $order->
    }
}

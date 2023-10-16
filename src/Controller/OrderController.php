<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    public function completeOrder(Request $request, OrderRepository $orderRepository): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderRepository->save($order, true);

            return $this->redirectToRoute('app_order_create', ['order' => $order], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $order,
            'form' => $form,
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository): Response
    {
        $user = $userRepository->findOneBy(['id' => $_POST['user']]);
        var_dump($user->getUserIdentifier());
        $cart = (array)json_decode($_POST['cart']);
        var_dump($cart);
        $orderInformation = $_POST['orderInfos'];

        $order = new Order();
        $order->setOrderDate(new \DateTime());
        $order->setUserCommand($user);
        $order->setOrderState(1);
        foreach ($cart as $idProduct => $commandProduct) {
            $product = $productRepository->findOneBy(['id' => $idProduct]);

            $order->addProduct($product);
        }
    }
}

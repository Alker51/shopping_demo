<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\StateOrder;
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
    #[Route('/complete', name: 'complete')]
    public function complete(Request $request, OrderRepository $orderRepository, ProductRepository $productRepository, UserRepository $userRepository): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $userRepository->findOneBy(['id' => $_POST['user']]);
            $order->setUserCommand($user);

            $cart = (array)json_decode($_POST['cart']);
            foreach ($cart as $idProduct => $commandProduct) {
                $product = $productRepository->findOneBy(['id' => $idProduct]);

                $order->addProduct($product);
            }

            $order->setOrderState(StateOrder::STATE['NO_VALID']);
            $orderRepository->save($order, true);

            return $this->redirectToRoute('app_order_validation', ['order' => $order], Response::HTTP_SEE_OTHER);
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            return $this->redirectToRoute('app_order_error', ['order' => $order], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order/index.html.twig', [
            'order' => $order,
            'form' => $form,
        ]);    }
    #[Route('/error', name: 'error')]
    public function error(): Response
    {
        print_r('Page d\'erreur.');
        exit;
        return $this->render('order/index.html.twig', [
            'controller_name' => 'Commandes récentes.',
        ]);
    }

    #[Route('/validation', name: 'validation')]
    public function validation(OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository): Response
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'Commandes récentes.',
        ]);
    }
}

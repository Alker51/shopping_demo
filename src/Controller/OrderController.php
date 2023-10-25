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
    #[Route('/manage', name: 'manage')]
    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to manage Order.')]
    public function admin(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy([], ['orderDate' => 'ASC']);

        return $this->render('order/admin.html.twig', [
            'controller_name' => 'Administration des commandes',
            'orders' => $orders
        ]);
    }

    #[Route('/', name: 'index')]
    public function index(OrderRepository $orderRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(['username' => $this->getUser()->getUserIdentifier()]);

        $orders = $orderRepository->findBy(['userCommand' => $user], ['orderDate' => 'ASC']);


        return $this->render('order/index.html.twig', [
            'controller_name' => 'Commandes récentes.',
            'orders' => $orders,
            'user' => $user
        ]);
    }

    #[Route('/complete', name: 'complete')]
    public function complete(Request $request, OrderRepository $orderRepository, ProductRepository $productRepository, UserRepository $userRepository): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $totalHT = 0.0;
            $totalTTC = 0.0;

            $user = $userRepository->findOneBy(['username' => $this->getUser()->getUserIdentifier()]);
            $order->setUserCommand($user);

            $cart = (array)json_decode($_POST['cart']);
            foreach ($cart as $idProduct => $commandProduct) {
                $product = $productRepository->findOneBy(['id' => $idProduct]);

                $order->addProduct($product);

                $totalHT += $product->getpriceWTax();
                if(!empty($product->getDiscountedPrice())) {
                    $totalTTC += $product->getDiscountedPrice();
                } else {
                    $totalTTC += $product->getPrice();
                }
            }
            $order->setTotalTax($totalTTC);
            $order->setTotalWTax($totalHT);

            $order->setNumOrder('SHPG-' . $order->getId());

            $order->setOrderDate(new \DateTime());
            $order->setOrderState(StateOrder::STATE['NO_VALID']);
            $orderRepository->save($order, true);

            return $this->redirectToRoute('app_order_validation', ['id' => $order->getId()], Response::HTTP_SEE_OTHER);
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            return $this->redirectToRoute('app_order_error', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order/complete.html.twig', [
            'order' => $order,
            'form' => $form,
            'cart' => $_POST['cart']
        ]);
    }
    #[Route('/error', name: 'error')]
    public function error(): Response
    {
        return $this->render('order/error.html.twig', [
            'controller_name' => 'Erreur Commandes.',
        ]);
    }

    #[Route('/validation/{id}', name: 'validation')]
    public function validation(Order $order, OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository): Response
    {
        return $this->render('order/validation.html.twig', [
            'controller_name' => 'Validation de la commande.',
            'order' => $order
        ]);
    }

    #[Route('/confirm/{id}', name: 'confirm')]
    public function confirm(Order $order, OrderRepository $orderRepository, UserRepository $userRepository, ProductRepository $productRepository): Response
    {
        $order->setOrderState(StateOrder::STATE['VALID']);
        $orderRepository->save($order, true);

        return $this->render('order/confirm.html.twig', [
            'controller_name' => 'Confirmation de votre commande : ' . $order->getNumOrder(),
            'order' => $order
        ]);
    }
}

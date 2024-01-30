<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/payment')]
class PaymentController extends AbstractController
{
    #[Route('/', name: 'payment')]
    public function index(Order $order, OrderRepository $orderRepository): Response
    {
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }

    public function checkIfcardValid() : Boolean
    {
        $result = false;
        return $result;
    }

    public function checkIfEnoughtMoney() : Boolean
    {
        $result = false;
        return $result;
    }
}

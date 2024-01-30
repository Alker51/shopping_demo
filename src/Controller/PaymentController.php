<?php

namespace App\Controller;

use App\Entity\CreditCard;
use App\Entity\Order;
use App\Form\PaymentType;
use App\Repository\CreditCardRepository;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/payment', name: 'app_payment_')]
class PaymentController extends AbstractController
{

}

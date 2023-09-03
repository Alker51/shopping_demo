<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/cart', name: 'app_cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session): Response
    {
        $cart = $session->get('panier', []);

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'panier' => $cart
        ]);
    }
#[Route('/add/{id}', name: 'add')]
    public function add(Product $product, SessionInterface $session, Request $request)
    {
        $id = $product->getId();
        $panier = $session->get('panier', []);

        empty($panier[$id]) ? $panier[$id] = (int)$request->request->get('qty', default: 1) : $panier[$id] += (int)$request->request->get('qty', default: 1);

        $session->set('panier', $panier);
        dd($session);
    }
}

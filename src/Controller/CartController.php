<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/cart', name: 'app_cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        $cart = $session->get('panier', []);
        $cartWithInfo = [];
        $totalCart = 0.0;
        if(!empty($cart)) {
            $productInCart = [];

            foreach ($cart as $idProduct => $qtyProduct) {
                $productInCart[] = $idProduct;
            }

            $productsCart = $productRepository->findBy(['id' => $productInCart]);

            foreach ($productsCart as $infoProduct) {
                $cartWithInfo[$infoProduct->getId()] = array(
                    'name' => $infoProduct->getProductName(),
                    'pics' => $infoProduct->getPicturesUrls(),
                    'qty' => $cart[$infoProduct->getId()]
                );

                if (is_null($infoProduct->getDiscountedPrice())) {
                    $cartWithInfo[$infoProduct->getId()]['total'] = $infoProduct->getPrice() * $cartWithInfo[$infoProduct->getId()]['qty'];
                } else {
                    $cartWithInfo[$infoProduct->getId()]['total'] = $infoProduct->getDiscountedPrice() * $cartWithInfo[$infoProduct->getId()]['qty'];
                }

                $totalCart += $cartWithInfo[$infoProduct->getId()]['total'];
            }
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cart' => $cartWithInfo,
            'total' => $totalCart
        ]);
    }
    #[Route('/add/{id}', name: 'add')]
    public function add(Product $product, SessionInterface $session, Request $request): RedirectResponse
    {
        $id = $product->getId();
        $panier = $session->get('panier', []);

        empty($panier[$id]) ? $panier[$id] = (int)$request->request->get('qty', default: 1) : $panier[$id] += (int)$request->request->get('qty', default: 1);

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Product $product, SessionInterface $session, Request $request): RedirectResponse
    {
        $id = $product->getId();
        $panier = $session->get('panier', []);

        if(array_key_exists($id, $panier)){
            if($panier[$id] > 1){
                $panier[$id] -= (int)$request->request->get('qty', default: 1);
            } else {
                unset($panier[$id]);
            }
        }


        $session->set('panier', $panier);
        return $this->redirectToRoute('app_cart_index');
    }
    #[Route('/removeAll', name: 'removeAll')]
    public function removeAll(SessionInterface $session, Request $request): RedirectResponse
    {
        $session->set('panier', []);
        return $this->redirectToRoute('app_cart_index');
    }
}

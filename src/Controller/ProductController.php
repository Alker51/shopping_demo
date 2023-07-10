<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        $search = $request->get('search', '');
        $products = $productRepository->search($search);

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_show', requirements: ['id' => '\d+'])]
    public function show(Product $product = null): Response
    {
        if(is_null($product)){
            throw $this->createNotFoundException('404 Le produit n\'existe pas.');
        }
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}

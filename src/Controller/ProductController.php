<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'app_product')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $products = $productRepository->search($search);

        foreach ($products as $key => $product)
            $products[$key] = $this->calculatedDiscountPrice($product, $productRepository);

        $view = 'product/index.html.twig';
        return $this->render($view, [
            'products' => $products,
            'search' => $search
        ]);
    }
    #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to create products.')]
    public function new(Request $request, ProductRepository $productRepository)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $product = $this->calculatedDiscountPrice($product, $productRepository);
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_product_manage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_show', requirements: ['id' => '\d+'])]
    public function show(Product $product = null, ProductRepository $productRepository): Response
    {
        if(is_null($product)){
            throw $this->createNotFoundException('404 Le produit n\'existe pas.');
        }

        $product = $this->calculatedDiscountPrice($product, $productRepository);

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to edit products.')]
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $this->calculatedDiscountPrice($product, $productRepository);
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_product_manage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_product_delete')]
    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to delete products.')]
    public function delete(Product $product, ProductRepository $productRepository): Response
    {
        $productRepository->remove($product, true);

        return $this->redirectToRoute('app_product_manage', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/manage', name: 'app_product_manage', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to manage products.')]
    public function manage(ProductRepository $productRepository, Request $request)
    {
        $search = $request->query->get('search', '');
        $products = $productRepository->search($search);

        foreach ($products as $key => $product)
            $products[$key] = $this->calculatedDiscountPrice($product, $productRepository);

        $view = 'product/admin.html.twig';
        return $this->render($view, [
            'products' => $products,
            'search' => $search
        ]);
    }

    private function calculatedDiscountPrice(Product $product, ProductRepository $productRepository) : Product
    {
            if(!is_null($product->getDiscount()) && !is_null($product->getPrice())) {
                $discountedPriceNew = $product->getPrice() - (round($product->getPrice() * ($product->getDiscount() / 100), 2));
                $discountedPriceOld = $product->getDiscountedPrice();
                
                if($discountedPriceOld !== $discountedPriceNew){
                    $product->setDiscountedPrice($product->getPrice() -  round($product->getPrice() * ($product->getDiscount() / 100), 2));

                    $productRepository->save($product, true);
                }
            }

        return $product;
    }
}

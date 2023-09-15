<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SessionInterface $session): Response
    {
        $user = $this->getUser();
        if(!empty($user)) {
            // $saveCart = ;
            // $panier = $user->getSaveCart();
            // $session->set('panier', $panier);
        }

        return $this->render('home/index.html.twig', [
            'title' => 'Shopping_Demo',
        ]);
    }
}

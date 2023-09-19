<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Session $session, UserRepository $userRepository): Response
    {
        $cartLoad = $session->get('cartLoad', false);
        $user = $this->getUser();

        if(!is_null($cartLoad) && !$cartLoad && !empty($user)){
            $this->loadSaveCart($userRepository, $session);
            $session->set('cartLoad', true);
        }

        return $this->render('home/index.html.twig', [
            'title' => 'Shopping_Demo',
        ]);
    }

    public function loadSaveCart(UserRepository $userRepository, Session $session): void
    {
        $user = $this->getUser();
        if(!empty($user)) {
            $connectedUsername = $user->getUserIdentifier();
            $user = $userRepository->findOneBy(['username' => $connectedUsername]);
            $saveCart = $user->getSaveCart();

            $session->set('panier', empty($saveCart) ? [] : $saveCart);

            $user->setSaveCart(null);
            $userRepository->save($user, true);
        }
    }
}

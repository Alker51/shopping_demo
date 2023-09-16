<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, UserRepository $userRepository, Session $session): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    public function saveCart(UserRepository $userRepository, Session $session): void
    {
        $cartToSave = $session->get('panier', []);
        $user = $this->getUser();
        if(!empty($user) && !empty($cartToSave)) {
            $connectedUsername = $user->getUserIdentifier();
            $user = $userRepository->findOneBy(['username' => $connectedUsername]);

            $user->setSaveCart($cartToSave);
            $userRepository->save($user, true);
        }
    }
    #[Route(path: '/disconnect', name: 'app_disconnect')]
    public function disconnect(UserRepository $userRepository, Session $session): Response
    {
        $this->saveCart($userRepository, $session);
        return $this->redirectToRoute('app_logout');
    }
}

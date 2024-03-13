<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

class LoginListener
{

    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function onSymfonyComponentSecurityHttpEventLoginSuccessEvent(LoginSuccessEvent $event): void
    {
        $repository = $this->em->getRepository(User::class);
        $session = $event->getRequest()->getSession();
        $this->loadCart($repository, $session, $event);
        /*
        If you need user...
        if (($token = $event->getToken()) && $user = $token->getUser()) {
            $user available
        }
        */
    }

    public function loadCart(EntityRepository $userRepository, Session $session, LoginSuccessEvent $event): void
    {
        $token = $event->getAuthenticatedToken();
        $user = $token->getUser();

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
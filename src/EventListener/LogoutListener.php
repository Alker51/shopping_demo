<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutListener {

    protected EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    public function onSymfonyComponentSecurityHttpEventLogoutEvent(LogoutEvent $event): void
    {
        $repository = $this->em->getRepository(User::class);
        $session = $event->getRequest()->getSession();
        $this->saveCart($repository, $session, $event);
        /*
        If you need user...
        if (($token = $event->getToken()) && $user = $token->getUser()) {
            $user available
        }
        */
    }

    public function saveCart(EntityRepository $userRepository, Session $session, LogoutEvent $event): void
    {
        print_r('ici');
        $cartToSave = $session->get('panier', []);
        $token = $event->getToken();
        $user = $token->getUser();
        $session->set('cartLoad', false);

        if(!empty($user) && !empty($cartToSave)) {
            $connectedUsername = $user->getUserIdentifier();
            $user = $userRepository->findOneBy(['username' => $connectedUsername]);

            $user->setSaveCart($cartToSave);
            $userRepository->save($user, true);
        }
    }
}

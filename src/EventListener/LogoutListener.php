<?php

namespace App\EventListener;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class LogoutListener {
    private $storage;
    public function __invoke(ExceptionEvent $event, UserRepository $userRepository, Session $session, TokenStorage $storage): void
    {
        $this->storage = $storage;
        $this->saveCart($userRepository, $session);
    }

    public function saveCart(UserRepository $userRepository, Session $session): void
    {
        $token = $this->storage->getToken();
        $user = $token ? $token->getUser() : null;
        $cartToSave = $session->get('panier', []);

        if(!empty($user) && !empty($cartToSave)) {
            $connectedUsername = $user->getUserIdentifier();
            $user = $userRepository->findOneBy(['username' => $connectedUsername]);

            $user->setSaveCart($cartToSave);
            $userRepository->save($user, true);
        }
    }
}

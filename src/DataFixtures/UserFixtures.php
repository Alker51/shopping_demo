<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.fr');
        $user->setFirstName('admin');
        $user->setLastName('admin');
        $user->setAvatarUrl('https://ui-avatars.com/api/?background=random&rounded=true&size=512&name=admin');
        $password = $this->hasher->hashPassword($user, 'admin51');
        $user->setPassword($password);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setIsVerified(true);

        $manager->persist($user);
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\StateOrder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class StateOrderFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (StateOrder::STATE as $name => $id) {
            $state = new StateOrder();
            $state->setStateNumber($id);
            $state->setName($name);
            $manager->persist($state);
            $manager->flush();
        }
    }
}

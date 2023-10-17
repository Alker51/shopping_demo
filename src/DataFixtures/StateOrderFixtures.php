<?php

namespace App\DataFixtures;

use App\Entity\StateOrder;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class StateOrderFixtures extends Fixture
{
    const STATE = [
        'NO_VALID' => 0,
        'VALID' => 1,
        'PROCESSING' => 2,
        'WAIT_SHIPPING' => 3,
        'SHIPPED' => 4,
        'ERROR' => 5
        ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::STATE as $name => $id) {
            $state = new StateOrder();
            $state->setStateNumber($id);
            $state->setName($name);
            $manager->persist($state);
            $manager->flush();
        }
    }
}

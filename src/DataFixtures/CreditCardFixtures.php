<?php

namespace App\DataFixtures;

use App\Entity\CreditCard;
use App\Factory\CreditCardFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class CreditCardFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $date = new DateTime("2026-12-01 00:00:00");
        $creditCard = new CreditCard();

        $creditCard->setCardHolderName("Alker Wolf");
        $creditCard->setCardNumber("1234567812345678");
        $creditCard->setCardVerificationValue(987);
        $creditCard->setValid(true);
        $creditCard->setExpirationDate($date);
        $creditCard->setBalance(4890.56);

        $manager->persist($creditCard);
        $manager->flush();

        CreditCardFactory::createMany(3);
    }
}

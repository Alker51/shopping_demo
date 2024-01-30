<?php

namespace App\Repository;

use App\Entity\CreditCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

/**
 * @extends ServiceEntityRepository<CreditCard>
 *
 * @method CreditCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditCard[]    findAll()
 * @method CreditCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditCard::class);
    }

    /**
     *  Check if a card is valid.
     *
     * @param string $cardNumber Number of credit card to verify information
     * @return bool True if OK, false if KO.
     */
    public function checkIfCardValid(string $cardNumber) : Boolean
    {
        $result = false;

        $card = $this->findOneBy(['cardNumber' => $cardNumber]);
        $dateNow = new DateTime();

        if(!empty($card))
            if($card->isValid() && $dateNow < $card->getExpirationDate())
                $result = true;

        return $result;
    }

    /**
     * Function to verify if a card had enough money.
     *
     * @param string $cardNumber Number of credit card to verify information
     * @param float $moneyTaken Amount of the command
     * @return bool  True if OK, false if KO.
     */
    public function checkIfEnoughtMoney(string $cardNumber, float $moneyTaken) : Boolean
    {
        $card = $this->findOneBy(['cardNumber' => $cardNumber]);
        $result = false;

        if($this->checkIfCardValid($cardNumber) && $card->getBalance() > $moneyTaken)
            $result = true;

        return $result;
    }
}

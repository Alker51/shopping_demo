<?php

namespace App\Entity;

use App\Repository\CreditCardRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditCardRepository::class)]
class CreditCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cardNumber = null;

    #[ORM\Column]
    private ?int $CardVerificationValue = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $ExpirationDate = null;

    #[ORM\Column(length: 255)]
    private ?string $cardHolderName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCardNumber(): ?int
    {
        return $this->cardNumber;
    }

    public function setCardNumber(int $cardNumber): static
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getCardVerificationValue(): ?int
    {
        return $this->CardVerificationValue;
    }

    public function setCardVerificationValue(int $CardVerificationValue): static
    {
        $this->CardVerificationValue = $CardVerificationValue;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->ExpirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $ExpirationDate): static
    {
        $this->ExpirationDate = $ExpirationDate;

        return $this;
    }

    public function getCardHolderName(): ?string
    {
        return $this->cardHolderName;
    }

    public function setCardHolderName(string $cardHolderName): static
    {
        $this->cardHolderName = $cardHolderName;

        return $this;
    }
}

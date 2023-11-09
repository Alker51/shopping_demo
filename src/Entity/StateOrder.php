<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StateOrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StateOrderRepository::class)]
#[ApiResource]
class StateOrder
{
    const STATE = [
        'NO_VALID' => 0,
        'VALID' => 1,
        'PROCESSING' => 2,
        'WAIT_SHIPPING' => 3,
        'SHIPPED' => 4,
        'ERROR' => 5,
        'CANCEL' => 6
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $stateNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStateNumber(): ?int
    {
        return $this->stateNumber;
    }

    public function setStateNumber(int $stateNumber): static
    {
        $this->stateNumber = $stateNumber;

        return $this;
    }
}

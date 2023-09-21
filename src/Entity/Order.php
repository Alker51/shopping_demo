<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $billingAdress = null;

    #[ORM\Column(length: 125)]
    private ?string $billingPostCode = null;

    #[ORM\Column(length: 255)]
    private ?string $billingTown = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingAdress = null;

    #[ORM\Column(length: 125)]
    private ?string $shippingPostCode = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingTown = null;

    #[ORM\Column(length: 255)]
    private ?string $billingCountry = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingCountry = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingPhoneNum = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingFirstName = null;

    #[ORM\Column(length: 255)]
    private ?string $shippingLastName = null;

    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'orders')]
    private Collection $Products;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userCommand = null;

    #[ORM\Column]
    private ?int $orderState = null;

    public function __construct()
    {
        $this->Products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBillingAdress(): ?string
    {
        return $this->billingAdress;
    }

    public function setBillingAdress(string $billingAdress): static
    {
        $this->billingAdress = $billingAdress;

        return $this;
    }

    public function getBillingPostCode(): ?string
    {
        return $this->billingPostCode;
    }

    public function setBillingPostCode(string $billingPostCode): static
    {
        $this->billingPostCode = $billingPostCode;

        return $this;
    }

    public function getBillingTown(): ?string
    {
        return $this->billingTown;
    }

    public function setBillingTown(string $billingTown): static
    {
        $this->billingTown = $billingTown;

        return $this;
    }

    public function getShippingAdress(): ?string
    {
        return $this->shippingAdress;
    }

    public function setShippingAdress(string $shippingAdress): static
    {
        $this->shippingAdress = $shippingAdress;

        return $this;
    }

    public function getShippingPostCode(): ?string
    {
        return $this->shippingPostCode;
    }

    public function setShippingPostCode(string $shippingPostCode): static
    {
        $this->shippingPostCode = $shippingPostCode;

        return $this;
    }

    public function getShippingTown(): ?string
    {
        return $this->shippingTown;
    }

    public function setShippingTown(string $shippingTown): static
    {
        $this->shippingTown = $shippingTown;

        return $this;
    }

    public function getBillingCountry(): ?string
    {
        return $this->billingCountry;
    }

    public function setBillingCountry(string $billingCountry): static
    {
        $this->billingCountry = $billingCountry;

        return $this;
    }

    public function getShippingCountry(): ?string
    {
        return $this->shippingCountry;
    }

    public function setShippingCountry(string $shippingCountry): static
    {
        $this->shippingCountry = $shippingCountry;

        return $this;
    }

    public function getShippingPhoneNum(): ?string
    {
        return $this->shippingPhoneNum;
    }

    public function setShippingPhoneNum(string $shippingPhoneNum): static
    {
        $this->shippingPhoneNum = $shippingPhoneNum;

        return $this;
    }

    public function getShippingFirstName(): ?string
    {
        return $this->shippingFirstName;
    }

    public function setShippingFirstName(string $shippingFirstName): static
    {
        $this->shippingFirstName = $shippingFirstName;

        return $this;
    }

    public function getShippingLastName(): ?string
    {
        return $this->shippingLastName;
    }

    public function setShippingLastName(string $shippingLastName): static
    {
        $this->shippingLastName = $shippingLastName;

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->Products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->Products->contains($product)) {
            $this->Products->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        $this->Products->removeElement($product);

        return $this;
    }

    public function getUserCommand(): ?User
    {
        return $this->userCommand;
    }

    public function setUserCommand(?User $userCommand): static
    {
        $this->userCommand = $userCommand;

        return $this;
    }

    public function getOrderState(): ?int
    {
        return $this->orderState;
    }

    public function setOrderState(int $orderState): static
    {
        $this->orderState = $orderState;

        return $this;
    }
}

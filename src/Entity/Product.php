<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(security: "is_granted('IS_AUTHENTICATED_FULLY') && is_granted('ROLE_ADMIN')")]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $productName = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 1000)]
    private ?string $picturesUrls = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $display = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?int $discount = null;

    #[ORM\Column(nullable: true)]
    private ?float $discountedPrice = null;

    #[ORM\Column]
    private ?float $priceWTax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): static
    {
        $this->productName = $productName;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPicturesUrls(): ?string
    {
        return $this->picturesUrls;
    }

    public function setPicturesUrls(string $picturesUrls): static
    {
        $this->picturesUrls = $picturesUrls;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isDisplay(): ?bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): static
    {
        $this->display = $display;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDiscountedPrice(): ?float
    {
        return $this->discountedPrice;
    }

    public function setDiscountedPrice(?float $discountedPrice): static
    {
        $this->discountedPrice = $discountedPrice;

        return $this;
    }

    public function getPriceWTax(): ?float
    {
        return $this->priceWTax;
    }

    public function setPriceWTax(float $priceWTax): static
    {
        $this->priceWTax = $priceWTax;

        return $this;
    }
}

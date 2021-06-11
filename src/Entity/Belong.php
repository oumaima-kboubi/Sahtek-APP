<?php

namespace App\Entity;

use App\Repository\BelongRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BelongRepository::class)
 */
class Belong
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Drug::class, inversedBy="belongs")
     */
    private $drug;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="belongs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Pharmacy;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $quantity;
//whatt
    /**
     * @ORM\Column(type="boolean")
     */
    private $Promotion;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $InitialPrice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $finalPrice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $pourcentage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDrug(): ?Drug
    {
        return $this->drug;
    }

    public function setDrug(?Drug $drug): self
    {
        $this->drug = $drug;

        return $this;
    }

    public function getPharmacy(): ?Person
    {
        return $this->Pharmacy;
    }

    public function setPharmacy(?Person $Pharmacy): self
    {
        $this->Pharmacy = $Pharmacy;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPromotion(): ?bool
    {
        return $this->Promotion;
    }

    public function setPromotion(bool $Promotion): self
    {
        $this->Promotion = $Promotion;

        return $this;
    }

    public function getInitialPrice(): ?string
    {
        return $this->InitialPrice;
    }

    public function setInitialPrice(string $InitialPrice): self
    {
        $this->InitialPrice = $InitialPrice;

        return $this;
    }

    public function getFinalPrice(): ?string
    {
        return $this->finalPrice;
    }

    public function setFinalPrice(string $finalPrice): self
    {
        $this->finalPrice = $finalPrice;

        return $this;
    }

    public function getPourcentage(): ?string
    {
        return $this->pourcentage;
    }

    public function setPourcentage(string $pourcentage): self
    {
        $this->pourcentage = $pourcentage;

        return $this;
    }
}

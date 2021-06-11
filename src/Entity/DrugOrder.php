<?php

namespace App\Entity;

use App\Repository\DrugOrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DrugOrderRepository::class)
 */
class DrugOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Drug::class, inversedBy="client")
     */
    private $Drug;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="drugOrders")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Person::class, inversedBy="drugOrders")
     */
    private $pharmacy;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $quantity;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Approved;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDrug(): ?Drug
    {
        return $this->Drug;
    }

    public function setDrug(?Drug $Drug): self
    {
        $this->Drug = $Drug;

        return $this;
    }

    public function getClient(): ?Person
    {
        return $this->client;
    }

    public function setClient(?Person $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPharmacy(): ?Person
    {
        return $this->pharmacy;
    }

    public function setPharmacy(?Person $pharmacy): self
    {
        $this->pharmacy = $pharmacy;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

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

    public function getApproved(): ?bool
    {
        return $this->Approved;
    }

    public function setApproved(bool $Approved): self
    {
        $this->Approved = $Approved;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }
}

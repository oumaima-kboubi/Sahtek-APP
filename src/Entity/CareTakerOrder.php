<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CarerTakerOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=CarerTakerOrderRepository::class)
 */
class CareTakerOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;




    /**
     * @ORM\Column(type="date")
     */
    private $day;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $finishTime;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $approved;


    /**
     * @Gedmo\Timestampable (on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable (on="update")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pending;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="careTakerOrders")
     */
    private $client;

//    /**
//     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="careTaker")
//     */
//    private $pharmacy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="careTakers")
     */
    private $caretaker;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getFinishTime(): ?\DateTimeInterface
    {
        return $this->finishTime;
    }

    public function setFinishTime(\DateTimeInterface $finishTime): self
    {
        $this->finishTime = $finishTime;

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

    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }



    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

//    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
//    {
//        $this->updatedAt = $updatedAt;
//
//        return $this;
//    }

public function getPending(): ?bool
{
    return $this->pending;
}

public function setPending(bool $pending): self
{
    $this->pending = $pending;

    return $this;
}

public function getDeleted(): ?bool
{
    return $this->deleted;
}

public function setDeleted(bool $deleted): self
{
    $this->deleted = $deleted;

    return $this;
}

public function getClient(): ?User
{
    return $this->client;
}

public function setClient(?User $client): self
{
    $this->client = $client;

    return $this;
}

//public function getPharmacy(): ?user
//{
//    return $this->pharmacy;
//}
//
//public function setPharmacy(?user $pharmacy): self
//{
//    $this->pharmacy = $pharmacy;
//
//    return $this;
//}

public function getCaretaker(): ?User
{
    return $this->caretaker;
}

public function setCaretaker(?User $caretaker): self
{
    $this->caretaker = $caretaker;

    return $this;
}
}

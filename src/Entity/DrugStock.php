<?php

namespace App\Entity;

use App\Repository\DrugStockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DrugStockRepository::class)
 */
class DrugStock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="drugStock", cascade={"persist", "remove"})
     */
    private $pharmacy;

    /**
     * @ORM\ManyToOne(targetEntity=DrugStockPharmacy::class, inversedBy="stock")
     */
    private $drugStockPharmacy;




    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPharmacy(): ?User
    {
        return $this->pharmacy;
    }

    public function setPharmacy(?User $pharmacy): self
    {
        $this->pharmacy = $pharmacy;

        return $this;
    }

    public function getDrugStockPharmacy(): ?DrugStockPharmacy
    {
        return $this->drugStockPharmacy;
    }

    public function setDrugStockPharmacy(?DrugStockPharmacy $drugStockPharmacy): self
    {
        $this->drugStockPharmacy = $drugStockPharmacy;

        return $this;
    }



}

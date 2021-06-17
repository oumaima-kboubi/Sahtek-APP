<?php

namespace App\Entity;

use App\Repository\DrugStockPharmacyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DrugStockPharmacyRepository::class)
 */
class DrugStockPharmacy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=DrugStock::class, mappedBy="drugStockPharmacy")
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity=Drug::class, mappedBy="drugStockPharmacy")
     */
    private $drug;
//drug 1----*dsp*
    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $quantity;

    public function __construct()
    {
        $this->stock = new ArrayCollection();
        $this->drug = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|DrugStock[]
     */
    public function getStock(): Collection
    {
        return $this->stock;
    }

    public function addStock(DrugStock $stock): self
    {
        if (!$this->stock->contains($stock)) {
            $this->stock[] = $stock;
            $stock->setDrugStockPharmacy($this);
        }

        return $this;
    }

    public function removeStock(DrugStock $stock): self
    {
        if ($this->stock->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getDrugStockPharmacy() === $this) {
                $stock->setDrugStockPharmacy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Drug[]
     */
    public function getDrug(): Collection
    {
        return $this->drug;
    }

    public function addDrug(Drug $drug): self
    {
        if (!$this->drug->contains($drug)) {
            $this->drug[] = $drug;
            $drug->setDrugStockPharmacy($this);
        }

        return $this;
    }

    public function removeDrug(Drug $drug): self
    {
        if ($this->drug->removeElement($drug)) {
            // set the owning side to null (unless already changed)
            if ($drug->getDrugStockPharmacy() === $this) {
                $drug->setDrugStockPharmacy(null);
            }
        }

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



}

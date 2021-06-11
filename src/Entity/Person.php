<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity=City::class, inversedBy="people")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adress;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $solde;

    /**
     * @ORM\Column(type="integer")
     */
    private $CIN;

    /**
     * @ORM\OneToMany(targetEntity=Belong::class, mappedBy="Pharmacy")
     */
    private $belongs;

    /**
     * @ORM\OneToMany(targetEntity=DrugOrder::class, mappedBy="client")
     */
    private $drugOrders;

    /**
     * @ORM\OneToMany(targetEntity=CareTakerOrder::class, mappedBy="client")
     */
    private $careTakerOrders;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Path;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity=CareTakerOrder::class, mappedBy="client")
     */
    private $orders;

    public function __construct()
    {
        $this->belongs = new ArrayCollection();
        $this->drugOrders = new ArrayCollection();
        $this->careTakerOrders = new ArrayCollection();
        $this->carerTakerOrders = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAdress(): ?City
    {
        return $this->adress;
    }

    public function setAdress(?City $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getCIN(): ?int
    {
        return $this->CIN;
    }

    public function setCIN(int $CIN): self
    {
        $this->CIN = $CIN;

        return $this;
    }

    /**
     * @return Collection|Belong[]
     */
    public function getBelongs(): Collection
    {
        return $this->belongs;
    }

    public function addBelong(Belong $belong): self
    {
        if (!$this->belongs->contains($belong)) {
            $this->belongs[] = $belong;
            $belong->setPharmacy($this);
        }

        return $this;
    }

    public function removeBelong(Belong $belong): self
    {
        if ($this->belongs->removeElement($belong)) {
            // set the owning side to null (unless already changed)
            if ($belong->getPharmacy() === $this) {
                $belong->setPharmacy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DrugOrder[]
     */
    public function getDrugOrders(): Collection
    {
        return $this->drugOrders;
    }

    public function addDrugOrder(DrugOrder $drugOrder): self
    {
        if (!$this->drugOrders->contains($drugOrder)) {
            $this->drugOrders[] = $drugOrder;
            $drugOrder->setClient($this);
        }

        return $this;
    }

    public function removeDrugOrder(DrugOrder $drugOrder): self
    {
        if ($this->drugOrders->removeElement($drugOrder)) {
            // set the owning side to null (unless already changed)
            if ($drugOrder->getClient() === $this) {
                $drugOrder->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CareTakerOrder[]
     */
    public function getCareTakerOrders(): Collection
    {
        return $this->careTakerOrders;
    }

    public function addCareTakerOrder(CareTakerOrder $careTakerOrder): self
    {
        if (!$this->careTakerOrders->contains($careTakerOrder)) {
            $this->careTakerOrders[] = $careTakerOrder;
            $careTakerOrder->setClient($this);
        }

        return $this;
    }

    public function removeCareTakerOrder(CareTakerOrder $careTakerOrder): self
    {
        if ($this->careTakerOrders->removeElement($careTakerOrder)) {
            // set the owning side to null (unless already changed)
            if ($careTakerOrder->getClient() === $this) {
                $careTakerOrder->setClient(null);
            }
        }

        return $this;
    }


    public function getPath(): ?string
    {
        return $this->Path;
    }

    public function setPath(string $Path): self
    {
        $this->Path = $Path;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|CareTakerOrder[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(CareTakerOrder $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setClient($this);
        }

        return $this;
    }

    public function removeOrder(CareTakerOrder $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getClient() === $this) {
                $order->setClient(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DrugRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=DrugRepository::class)
 * @Vich\Uploadable()
 */
class Drug
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="drugs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="drugs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity=Belong::class, mappedBy="drug")
     */
    private $belongs;

    /**
     * @ORM\OneToMany(targetEntity=DrugOrder::class, mappedBy="Drug")
     */
    private $drugOrders;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     *
     */
    private $featured_image;

    /**
     * @Vich\UploadableField(mapping="featured_images",fileNameProperty="featured_image")
     * @var File
     */
    private $imageFile;
    /**
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable (on="update")
     */
    private $updatedAt;

    /**
     * @Gedmo\Timestampable (on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=DrugStockPharmacy::class, mappedBy="drug")
     */
    private $drugStockPharmacies;

    /**
     * @ORM\ManyToOne(targetEntity=DrugStockPharmacy::class, inversedBy="drug")
     */
    private $drugStockPharmacy;


    public function __construct()
    {
        $this->belongs = new ArrayCollection();
        $this->client = new ArrayCollection();
        $this->drugOrders = new ArrayCollection();
        $this->updatedAt = new DateTime('now');
        $this->drugStockPharmacies = new ArrayCollection();
    }


    //    /**
//     * @Gedmo\Slug(fields={"Name"})
//     * @ORM\Column( length=128, unique=true)
//     */
//    private $slug;

//    /**
//     * @var DateTime $created_at
//     *
//     * @Gedmo\Timestampable (on="create")
//     * @ORM\Column(type="datetime")
//     */
//    private $created_at;
//
//    /**
//     * @var DateTime $updated_at
//     * @Gedmo\Timestampable (on="update")
//     * @ORM\Column(type="datetime")
//     */
//    private $updated_at;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?Category
    {
        return $this->type;
    }

    public function setType(?Category $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

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
            $belong->setDrug($this);
        }

        return $this;
    }

    public function removeBelong(Belong $belong): self
    {
        if ($this->belongs->removeElement($belong)) {
            // set the owning side to null (unless already changed)
            if ($belong->getDrug() === $this) {
                $belong->setDrug(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DrugOrder[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(DrugOrder $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
            $client->setDrug($this);
        }

        return $this;
    }

    public function removeClient(DrugOrder $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getDrug() === $this) {
                $client->setDrug(null);
            }
        }

        return $this;
    }

    //    public function getSlug(): ?string
//    {
//        return $this->slug;
//    }

    /* public function setSlug(string $slug): self
     {
         $this->slug = $slug;

         return $this;
     }*/

//   public function getCreatedAt(): ?\DateTimeInterface
//   {
//       return $this->created_at;
//   }

//   public function setCreatedAt(\DateTimeInterface $created_at): self
//   {
//       $this->created_at = $created_at;
//
//       return $this;
//   }

//   public function getUpdatedAt(): ?\DateTimeInterface
//   {
//       return $this->updated_at;
//   }

//   public function setUpdatedAt(\DateTimeInterface $updated_at): self
//   {
//       $this->updated_at = $updated_at;
//
//       return $this;
//   }

    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    public function setFeaturedImage(string $featured_image)
    {
        $this->featured_image = $featured_image;

        return $this;
    }


    /**
     * @param mixed $image
     *
     */
    public function setImageFile($image): void
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
    }

    /**
     * @return mixed
     *
     */
    public function getImageFile()
    {
        return $this->imageFile;
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
            $drugOrder->setDrug($this);
        }

        return $this;
    }

    public function removeDrugOrder(DrugOrder $drugOrder): self
    {
        if ($this->drugOrders->removeElement($drugOrder)) {
            // set the owning side to null (unless already changed)
            if ($drugOrder->getDrug() === $this) {
                $drugOrder->setDrug(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

//    public function setCreatedAt(\DateTimeInterface $createdAt): self
//    {
//        $this->createdAt = $createdAt;
//
//        return $this;
//    }

/**
 * @return Collection|DrugStockPharmacy[]
 */
public function getDrugStockPharmacies(): Collection
{
    return $this->drugStockPharmacies;
}

public function addDrugStockPharmacy(DrugStockPharmacy $drugStockPharmacy): self
{
    if (!$this->drugStockPharmacies->contains($drugStockPharmacy)) {
        $this->drugStockPharmacies[] = $drugStockPharmacy;
        $drugStockPharmacy->setDrug($this);
    }

    return $this;
}

public function removeDrugStockPharmacy(DrugStockPharmacy $drugStockPharmacy): self
{
    if ($this->drugStockPharmacies->removeElement($drugStockPharmacy)) {
        // set the owning side to null (unless already changed)
        if ($drugStockPharmacy->getDrug() === $this) {
            $drugStockPharmacy->setDrug(null);
        }
    }

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

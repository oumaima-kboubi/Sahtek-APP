<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EntrepriseRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 * @Vich\Uploadable()
 */
class Entreprise
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Drug::class, mappedBy="entreprise")
     */
    private $drugs;

//    /**
//     * @Gedmo\Slug(fields={"name"})
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
//    private  $updated_at;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;




    public function __construct()
    {
        $this->drugs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Drug[]
     */
    public function getDrugs(): Collection
    {
        return $this->drugs;
    }

    public function addDrug(Drug $drug): self
    {
        if (!$this->drugs->contains($drug)) {
            $this->drugs[] = $drug;
            $drug->setEntreprise($this);
        }

        return $this;
    }

    public function removeDrug(Drug $drug): self
    {
        if ($this->drugs->removeElement($drug)) {
            // set the owning side to null (unless already changed)
            if ($drug->getEntreprise() === $this) {
                $drug->setEntreprise(null);
            }
        }

        return $this;
    }

//    public function getSlug(): ?string
//    {
//        return $this->slug;
//    }

//    public function setSlug(string $slug): self
//    {
//        $this->slug = $slug;
//
//        return $this;
//    }
//
//public function getCreatedAt(): ?\DateTimeInterface
//{
//    return $this->created_at;
//}

//public function setCreatedAt(\DateTimeInterface $created_at): self
//{
//    $this->created_at = $created_at;
//
//    return $this;
//}
//
//public function getUpdatedAt(): ?\DateTimeInterface
//{
//    return $this->updated_at;
//}

//public function setUpdatedAt(\DateTimeInterface $updated_at): self
//{
//    $this->updated_at = $updated_at;
//
//    return $this;
//}

    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    public function setFeaturedImage(string $featured_image)
    {
        $this->featured_image = $featured_image;

        return $this;
    }
    public function setImageFile( $image = null)
    {
        $this->imageFile=$image;

        if($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }
    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function __toString()
    {
        return $this->name;
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

public function getDescription(): ?string
{
    return $this->description;
}

public function setDescription(string $description): self
{
    $this->description = $description;

    return $this;
}


}

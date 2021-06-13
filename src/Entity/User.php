<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;


    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @return mixed
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param mixed $birthDate
     */
    public function setBirthDate($birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $CIN;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $solde;

//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    private $username;

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
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToOne(targetEntity=DrugStock::class, mappedBy="pharmacy", cascade={"persist", "remove"})
     */
    private $drugStock;

    /**
     * @ORM\OneToMany(targetEntity=CareTakerOrder::class, mappedBy="client")
     */
    private $careTakerOrders;

    /**
     * @ORM\OneToMany(targetEntity=CareTakerOrder::class, mappedBy="pharmacy")
     */
    private $careTaker;

    /**
     * @ORM\OneToMany(targetEntity=CareTakerOrder::class, mappedBy="caretaker")
     */
    private $careTakers;

    /**
     * @ORM\OneToMany(targetEntity=DrugOrder::class, mappedBy="client")
     */
    private $drugOrders;




    public function __construct()
    {
//        parent::__construct();
        $this->setRoles(["ROLE_USER"]);
        $this->setFeaturedImage('images/avatar.jpeg');
        $this->setSolde(0);
        $this->careTakerOrders = new ArrayCollection();
        $this->careTakers = new ArrayCollection();
        $this->drugOrders = new ArrayCollection();


    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getIsVerified(): ?bool
    {
        return $this->isVerified;
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

    public function getCIN(): ?int
    {
        return $this->CIN;
    }

    public function setCIN(int $CIN): self
    {
        $this->CIN = $CIN;

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

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
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
            $this->updatedAt = new \DateTime('now');
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

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

    public function getDrugStock(): ?DrugStock
    {
        return $this->drugStock;
    }

    public function setDrugStock(?DrugStock $drugStock): self
    {
        // unset the owning side of the relation if necessary
        if ($drugStock === null && $this->drugStock !== null) {
            $this->drugStock->setPharmacy(null);
        }

        // set the owning side of the relation if necessary
        if ($drugStock !== null && $drugStock->getPharmacy() !== $this) {
            $drugStock->setPharmacy($this);
        }

        $this->drugStock = $drugStock;

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

    /**
     * @return Collection|CareTakerOrder[]
     */
    public function getCareTakers(): Collection
    {
        return $this->careTakers;
    }

    public function addCareTaker(CareTakerOrder $careTaker): self
    {
        if (!$this->careTakers->contains($careTaker)) {
            $this->careTakers[] = $careTaker;
            $careTaker->setCaretaker($this);
        }

        return $this;
    }

    public function removeCareTaker(CareTakerOrder $careTaker): self
    {
        if ($this->careTakers->removeElement($careTaker)) {
            // set the owning side to null (unless already changed)
            if ($careTaker->getCaretaker() === $this) {
                $careTaker->setCaretaker(null);
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




}

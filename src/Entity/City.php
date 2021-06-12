<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
class City
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
     * @ORM\OneToMany(targetEntity=Person::class, mappedBy="adress")
     *
     */
    private $people;
// @ORM\OneToMany(targetEntity=User::class, mappedBy="adress")
//    /**
//     *
//     * @ORM\Column(type="string", length=255)
//     */
//    private $users;

    public function __construct()
    {
        $this->people = new ArrayCollection();
        $this->users = new ArrayCollection();
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
     * @return Collection|Person[]
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(Person $person): self
    {
        if (!$this->people->contains($person)) {
            $this->people[] = $person;
            $person->setAdress($this);
        }

        return $this;
    }

    public function removePerson(Person $person): self
    {
        if ($this->people->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getAdress() === $this) {
                $person->setAdress(null);
            }
        }

        return $this;
    }

//    /**
//     * @return Collection|User[]
//     */
//    public function getUsers(): Collection
//    {
//        return $this->users;
//    }
//
//    public function addUser(User $user): self
//    {
//        if (!$this->users->contains($user)) {
//            $this->users[] = $user;
//            $user->setAdress($this);
//        }
//
//        return $this;
//    }
//
//    public function removeUser(User $user): self
//    {
//        if ($this->users->removeElement($user)) {
//            // set the owning side to null (unless already changed)
//            if ($user->getAdress() === $this) {
//                $user->setAdress(null);
//            }
//        }
//
//        return $this;
//    }
}

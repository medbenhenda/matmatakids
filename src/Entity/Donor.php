<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonorRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Donor
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Don", mappedBy="donor", cascade={"persist"})
     */
    private $dons;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="donors")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default"=false})
     */
    private $isAdherent;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $validityAdhesion;


    public function __construct()
    {
        $this->dons = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Don[]
     */
    public function getDons(): Collection
    {
        return $this->dons;
    }

    public function addDon(Don $don): self
    {
        if (!$this->dons->contains($don)) {
            $this->dons[] = $don;
            $don->setDonor($this);
        }

        return $this;
    }

    public function removeDon(Don $don): self
    {
        if ($this->dons->contains($don)) {
            $this->dons->removeElement($don);
            // set the owning side to null (unless already changed)
            if ($don->getDonor() === $this) {
                $don->setDonor(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function constructName()
    {
        return $this->id.'_'.$this->firstName . '_' . $this->lastName;
    }

    /**
     * @return string
     */
    public function constructAddress(): string
    {
        return $this->address . ' '.$this->getZipCode().' '.$this->getCity().' '.$this->getCountry();
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getIsAdherent(): ?bool
    {
        return $this->isAdherent;
    }

    public function setIsAdherent(bool $isAdherent): self
    {
        $this->isAdherent = $isAdherent;

        return $this;
    }

    public function getValidityAdhesion(): ?string
    {
        return $this->validityAdhesion;
    }

    public function setValidityAdhesion(?string $validityAdhesion): self
    {
        $this->validityAdhesion = $validityAdhesion;

        return $this;
    }
}

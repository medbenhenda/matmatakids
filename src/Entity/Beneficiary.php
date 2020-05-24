<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeneficiaryRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Beneficiary
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $schoolLevel;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isOrphan;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isHandicapped;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isUnhealty;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isSchoolBoy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $particularCase;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $favoriteActivity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Project", inversedBy="beneficiaries")
     */
    private $project;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $haveAFolder;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="beneficiaries")
     */
    private $createdBy;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Folder", inversedBy="beneficiary", cascade={"persist", "remove"})
     */
    private $folder;

    public function __construct()
    {
        $this->project = new ArrayCollection();
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

    public function getBirhdate(): ?\DateTimeInterface
    {
        return $this->birhdate;
    }

    public function setBirhdate(?\DateTimeInterface $birhdate): self
    {
        $this->birhdate = $birhdate;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
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

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSchoolLevel(): ?string
    {
        return $this->schoolLevel;
    }

    public function setSchoolLevel(?string $schoolLevel): self
    {
        $this->schoolLevel = $schoolLevel;

        return $this;
    }

    public function getIsOrphan(): ?bool
    {
        return $this->isOrphan;
    }

    public function setIsOrphan(?bool $isOrphan): self
    {
        $this->isOrphan = $isOrphan;

        return $this;
    }

    public function getIsHandicapped(): ?bool
    {
        return $this->isHandicapped;
    }

    public function setIsHandicapped(?bool $isHandicapped): self
    {
        $this->isHandicapped = $isHandicapped;

        return $this;
    }

    public function getIsUnhealty(): ?bool
    {
        return $this->isUnhealty;
    }

    public function setIsUnhealty(?bool $isUnhealty): self
    {
        $this->isUnhealty = $isUnhealty;

        return $this;
    }

    public function getIsSchoolBoy(): ?bool
    {
        return $this->isSchoolBoy;
    }

    public function setIsSchoolBoy(?bool $isSchoolBoy): self
    {
        $this->isSchoolBoy = $isSchoolBoy;

        return $this;
    }

    public function getParticularCase(): ?string
    {
        return $this->particularCase;
    }

    public function setParticularCase(?string $particularCase): self
    {
        $this->particularCase = $particularCase;

        return $this;
    }

    public function getFavoriteActivity(): ?string
    {
        return $this->favoriteActivity;
    }

    public function setFavoriteActivity(?string $favoriteActivity): self
    {
        $this->favoriteActivity = $favoriteActivity;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    public function addProject(Project $project): self
    {
        if (!$this->project->contains($project)) {
            $this->project[] = $project;
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->project->contains($project)) {
            $this->project->removeElement($project);
        }

        return $this;
    }

    public function getHaveAFolder(): ?bool
    {
        return $this->haveAFolder;
    }

    public function setHaveAFolder(?bool $haveAFolder): self
    {
        $this->haveAFolder = $haveAFolder;

        return $this;
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

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }
}

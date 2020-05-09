<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User implements UserInterface
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $enterDate;

    /**
     * @ORM\Column(type="boolean", options={"default":true}, nullable=true)
     */
    private $isActive;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Don", mappedBy="createdBy")
     */
    private $dons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Donor", mappedBy="createdBy")
     */
    private $donors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="createdBy")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Folder", mappedBy="createdBy")
     */
    private $folders;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sponsor", mappedBy="createdBy")
     */
    private $sponsors;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="createdBy")
     */
    private $documents;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affectation", mappedBy="affectedBy")
     */
    private $affectations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affectation", mappedBy="createdBy")
     */
    private $ownAffectaions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProposingTransaction", mappedBy="createdBy")
     */
    private $proposingTransactions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProposingTransaction", mappedBy="responsible")
     */
    private $responsibleTransactions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Expenses", mappedBy="createdBy")
     */
    private $expenses;



    public function __construct()
    {
        $this->dons = new ArrayCollection();
        $this->donors = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->folders = new ArrayCollection();
        $this->sponsors = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->affectations = new ArrayCollection();
        $this->ownAffectaions = new ArrayCollection();
        $this->proposingTransactions = new ArrayCollection();
        $this->responsibleTransactions = new ArrayCollection();
        $this->expenses = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
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
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getEnterDate(): ?\DateTimeInterface
    {
        return $this->enterDate;
    }

    public function setEnterDate(?\DateTimeInterface $enterDate): self
    {
        $this->enterDate = $enterDate;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
            $don->setCreatedBy($this);
        }

        return $this;
    }

    public function removeDon(Don $don): self
    {
        if ($this->dons->contains($don)) {
            $this->dons->removeElement($don);
            // set the owning side to null (unless already changed)
            if ($don->getCreatedBy() === $this) {
                $don->setCreaedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Donor[]
     */
    public function getDonors(): Collection
    {
        return $this->donors;
    }

    public function addDonor(Donor $donor): self
    {
        if (!$this->donors->contains($donor)) {
            $this->donors[] = $donor;
            $donor->setCreatedBy($this);
        }

        return $this;
    }

    public function removeDonor(Donor $donor): self
    {
        if ($this->donors->contains($donor)) {
            $this->donors->removeElement($donor);
            // set the owning side to null (unless already changed)
            if ($donor->getCreatedBy() === $this) {
                $donor->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getCreatedBy() === $this) {
                $project->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Folder[]
     */
    public function getFolders(): Collection
    {
        return $this->folders;
    }

    public function addFolder(Folder $folder): self
    {
        if (!$this->folders->contains($folder)) {
            $this->folders[] = $folder;
            $folder->setCreatedBy($this);
        }

        return $this;
    }

    public function removeFolder(Folder $folder): self
    {
        if ($this->folders->contains($folder)) {
            $this->folders->removeElement($folder);
            // set the owning side to null (unless already changed)
            if ($folder->getCreatedBy() === $this) {
                $folder->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sponsor[]
     */
    public function getSponsors(): Collection
    {
        return $this->sponsors;
    }

    public function addSponsor(Sponsor $sponsor): self
    {
        if (!$this->sponsors->contains($sponsor)) {
            $this->sponsors[] = $sponsor;
            $sponsor->setCreatedBy($this);
        }

        return $this;
    }

    public function removeSponsor(Sponsor $sponsor): self
    {
        if ($this->sponsors->contains($sponsor)) {
            $this->sponsors->removeElement($sponsor);
            // set the owning side to null (unless already changed)
            if ($sponsor->getCreatedBy() === $this) {
                $sponsor->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->$documents;
    }

    public function addDocument(Sponsor $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setCreatedBy($this);
        }

        return $this;
    }

    public function removeDocument(Sponsor $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getCreatedBy() === $this) {
                $document->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Affectation[]
     */
    public function getAffectations(): Collection
    {
        return $this->affectations;
    }

    public function addAffectation(Affectation $affectation): self
    {
        if (!$this->affectations->contains($affectation)) {
            $this->affectations[] = $affectation;
            $affectation->setAffectedBy($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): self
    {
        if ($this->affectations->contains($affectation)) {
            $this->affectations->removeElement($affectation);
            // set the owning side to null (unless already changed)
            if ($affectation->getAffectedBy() === $this) {
                $affectation->setAffectedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Affectation[]
     */
    public function getOwnAffectaions(): Collection
    {
        return $this->ownAffectaions;
    }

    public function addOwnAffectaion(Affectation $ownAffectaion): self
    {
        if (!$this->ownAffectaions->contains($ownAffectaion)) {
            $this->ownAffectaions[] = $ownAffectaion;
            $ownAffectaion->setCreatedBy($this);
        }

        return $this;
    }

    public function removeOwnAffectaion(Affectation $ownAffectaion): self
    {
        if ($this->ownAffectaions->contains($ownAffectaion)) {
            $this->ownAffectaions->removeElement($ownAffectaion);
            // set the owning side to null (unless already changed)
            if ($ownAffectaion->getCreatedBy() === $this) {
                $ownAffectaion->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProposingTransaction[]
     */
    public function getProposingTransactions(): Collection
    {
        return $this->proposingTransactions;
    }

    public function addProposingTransaction(ProposingTransaction $proposingTransaction): self
    {
        if (!$this->proposingTransactions->contains($proposingTransaction)) {
            $this->proposingTransactions[] = $proposingTransaction;
            $proposingTransaction->setCreatedBy($this);
        }

        return $this;
    }

    public function removeProposingTransaction(ProposingTransaction $proposingTransaction): self
    {
        if ($this->proposingTransactions->contains($proposingTransaction)) {
            $this->proposingTransactions->removeElement($proposingTransaction);
            // set the owning side to null (unless already changed)
            if ($proposingTransaction->getCreatedBy() === $this) {
                $proposingTransaction->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProposingTransaction[]
     */
    public function getResponsibleTransactions(): Collection
    {
        return $this->responsibleTransactions;
    }

    public function addResponsibleTransaction(ProposingTransaction $responsibleTransaction): self
    {
        if (!$this->responsibleTransactions->contains($responsibleTransaction)) {
            $this->responsibleTransactions[] = $responsibleTransaction;
            $responsibleTransaction->setResponsible($this);
        }

        return $this;
    }

    public function removeResponsibleTransaction(ProposingTransaction $responsibleTransaction): self
    {
        if ($this->responsibleTransactions->contains($responsibleTransaction)) {
            $this->responsibleTransactions->removeElement($responsibleTransaction);
            // set the owning side to null (unless already changed)
            if ($responsibleTransaction->getResponsible() === $this) {
                $responsibleTransaction->setResponsible(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Expenses[]
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expenses $expense): self
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses[] = $expense;
            $expense->setCreatedBy($this);
        }

        return $this;
    }

    public function removeExpense(Expenses $expense): self
    {
        if ($this->expenses->contains($expense)) {
            $this->expenses->removeElement($expense);
            // set the owning side to null (unless already changed)
            if ($expense->getCreatedBy() === $this) {
                $expense->setCreatedBy(null);
            }
        }

        return $this;
    }
}

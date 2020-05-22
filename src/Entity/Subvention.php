<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubventionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Subvention
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
    private $entreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $entrepriseAddress;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $entrepriseEmail;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $entreprisePhone1;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $entreprisePhone2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $depositeDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="subventions")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="subventionDoc", cascade={"persist", "remove"})
     */
    private $documents;

    /**
     * Subvention constructor.
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    /**
     * @param string $entreprise
     * @return $this
     */
    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrepriseAddress(): ?string
    {
        return $this->entrepriseAddress;
    }

    /**
     * @param string $entrepriseAddress
     * @return $this
     */
    public function setEntrepriseAddress(string $entrepriseAddress): self
    {
        $this->entrepriseAddress = $entrepriseAddress;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntrepriseEmail(): ?string
    {
        return $this->entrepriseEmail;
    }

    /**
     * @param string|null $entrepriseEmail
     * @return $this
     */
    public function setEntrepriseEmail(?string $entrepriseEmail): self
    {
        $this->entrepriseEmail = $entrepriseEmail;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntreprisePhone1(): ?string
    {
        return $this->entreprisePhone1;
    }

    /**
     * @param string|null $entreprisePhone1
     * @return $this
     */
    public function setEntreprisePhone1(?string $entreprisePhone1): self
    {
        $this->entreprisePhone1 = $entreprisePhone1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntreprisePhone2(): ?string
    {
        return $this->entreprisePhone2;
    }

    /**
     * @param string|null $entreprisePhone2
     * @return $this
     */
    public function setEntreprisePhone2(?string $entreprisePhone2): self
    {
        $this->entreprisePhone2 = $entreprisePhone2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDepositeDate(): ?\DateTimeInterface
    {
        return $this->depositeDate;
    }

    /**
     * @param \DateTimeInterface|null $depositeDate
     * @return $this
     */
    public function setDepositeDate(?\DateTimeInterface $depositeDate): self
    {
        $this->depositeDate = $depositeDate;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    /**
     * @param User|null $createdBy
     * @return $this
     */
    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    /**
     * @param Document $document
     * @return $this
     */
    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setSubventionDoc($this);
        }

        return $this;
    }

    /**
     * @param Document $document
     * @return $this
     */
    public function removeDocument(Document $document): self
    {
        if ($this->documents->contains($document)) {
            $this->documents->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getSubventionDoc() === $this) {
                $document->setSubventionDoc(null);
            }
        }

        return $this;
    }
}

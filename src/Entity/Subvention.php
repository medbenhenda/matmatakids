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
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="subvention")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="subventionDoc")
     */
    private $documents;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getEntrepriseAddress(): ?string
    {
        return $this->entrepriseAddress;
    }

    public function setEntrepriseAddress(string $entrepriseAddress): self
    {
        $this->entrepriseAddress = $entrepriseAddress;

        return $this;
    }

    public function getEntrepriseEmail(): ?string
    {
        return $this->entrepriseEmail;
    }

    public function setEntrepriseEmail(?string $entrepriseEmail): self
    {
        $this->entrepriseEmail = $entrepriseEmail;

        return $this;
    }

    public function getEntreprisePhone1(): ?string
    {
        return $this->entreprisePhone1;
    }

    public function setEntreprisePhone1(?string $entreprisePhone1): self
    {
        $this->entreprisePhone1 = $entreprisePhone1;

        return $this;
    }

    public function getEntreprisePhone2(): ?string
    {
        return $this->entreprisePhone2;
    }

    public function setEntreprisePhone2(?string $entreprisePhone2): self
    {
        $this->entreprisePhone2 = $entreprisePhone2;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

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

    public function getDepositeDate(): ?\DateTimeInterface
    {
        return $this->depositeDate;
    }

    public function setDepositeDate(?\DateTimeInterface $depositeDate): self
    {
        $this->depositeDate = $depositeDate;

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

    /**
     * @return Collection|Document[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Document $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setSubvention($this);
        }

        return $this;
    }

    public function removeImage(Document $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getSubvention() === $this) {
                $image->setSubvention(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents[] = $document;
            $document->setSubventionDoc($this);
        }

        return $this;
    }

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

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FolderRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Folder
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $details;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="folders", cascade={"persist"})
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="folder", cascade={"remove"}, cascade={"persist"})
     */
    private $proof;

    /**
     * @ORM\Column(type="boolean", options={"default":false}, nullable=true)
     */
    private $affected;

    /**
     * @ORM\Column(type="boolean", options={"default":false}, nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affectation", mappedBy="folder")
     */
    private $affectations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FolderItem", mappedBy="folder")
     */
    private $folderItems;

    public function __construct()
    {
        $this->proof = new ArrayCollection();
        $this->affectations = new ArrayCollection();
        $this->folderItems = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->id . '/' . $this->createdAt->format('Y');
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

    public function setEmail(?string $email): self
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

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

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
    public function getProof(): Collection
    {
        return $this->proof;
    }

    public function addProof(Document $proof): self
    {
        if (!$this->proof->contains($proof)) {
            $this->proof[] = $proof;
            $proof->setFolder($this);
        }

        return $this;
    }

    public function removeProof(Document $proof): self
    {
        if ($this->proof->contains($proof)) {
            $this->proof->removeElement($proof);
            // set the owning side to null (unless already changed)
            if ($proof->getFolder() === $this) {
                $proof->setFolder(null);
            }
        }

        return $this;
    }

    public function getAffected(): ?bool
    {
        return $this->affected;
    }

    public function setAffected(bool $affected): self
    {
        $this->affected = $affected;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
            $affectation->setFolder($this);
        }

        return $this;
    }

    public function removeAffectation(Affectation $affectation): self
    {
        if ($this->affectations->contains($affectation)) {
            $this->affectations->removeElement($affectation);
            // set the owning side to null (unless already changed)
            if ($affectation->getFolder() === $this) {
                $affectation->setFolder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FolderItem[]
     */
    public function getFolderItems(): Collection
    {
        return $this->folderItems;
    }

    public function addFolderItem(FolderItem $folderItem): self
    {
        if (!$this->folderItems->contains($folderItem)) {
            $this->folderItems[] = $folderItem;
            $folderItem->setFolder($this);
        }

        return $this;
    }

    public function removeFolderItem(FolderItem $folderItem): self
    {
        if ($this->folderItems->contains($folderItem)) {
            $this->folderItems->removeElement($folderItem);
            // set the owning side to null (unless already changed)
            if ($folderItem->getFolder() === $this) {
                $folderItem->setFolder(null);
            }
        }

        return $this;
    }
}

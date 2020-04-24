<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FolderItemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FolderItem
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
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $handicapped;

    /**
     * @ORM\Column(type="boolean")
     */
    private $unhealthy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $orphan;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
     
    private $schoolboy;
    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="folderItem")
     */
    private $certificates;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Folder", inversedBy="folderItems")
     */
    private $folder;

    public function __construct()
    {
        $this->certificates = new ArrayCollection();
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

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getHandicapped(): ?bool
    {
        return $this->handicapped;
    }

    public function setHandicapped(bool $handicapped): self
    {
        $this->handicapped = $handicapped;

        return $this;
    }

    public function getUnhealthy(): ?bool
    {
        return $this->unhealthy;
    }

    public function setUnhealthy(bool $unhealthy): self
    {
        $this->unhealthy = $unhealthy;

        return $this;
    }

    public function getOrphan(): ?bool
    {
        return $this->orphan;
    }

    public function setOrphan(bool $orphan): self
    {
        $this->orphan = $orphan;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSchoolboy(): ?bool
    {
        return $this->schoolboy;
    }

    public function setSchoolboy(?bool $schoolboy): self
    {
        $this->schoolboy = $schoolboy;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getCertificates(): Collection
    {
        return $this->certificates;
    }

    public function addCertificate(Document $certificate): self
    {
        if (!$this->certificates->contains($certificate)) {
            $this->certificates[] = $certificate;
            $certificate->setFolderItem($this);
        }

        return $this;
    }

    public function removeCertificate(Document $certificate): self
    {
        if ($this->certificates->contains($certificate)) {
            $this->certificates->removeElement($certificate);
            // set the owning side to null (unless already changed)
            if ($certificate->getFolderItem() === $this) {
                $certificate->setFolderItem(null);
            }
        }

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
}

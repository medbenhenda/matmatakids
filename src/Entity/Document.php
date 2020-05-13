<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 */
class Document
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @Vich\UploadableField(mapping="document_proof", fileNameProperty="imageName", size="imageSize")
     *
     * @var File|null
     */
     private $imageFile;

    /**
     * @ORM\Column(type="string", nullable=true))
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer", nullable=true))
     *
     * @var int|null
     */
    private $imageSize;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $section;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="documents")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Folder", inversedBy="proof", cascade={"persist"})
     */
    private $folder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $docFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FolderItem", inversedBy="certificates", cascade={"persist"})
     */
    private $folderItem;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Expenses", inversedBy="invoice", cascade={"persist"})
     */
    private $expenses;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subvention", inversedBy="images")
     */
    private $subvention;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subvention", inversedBy="documents")
     */
    private $subventionDoc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection(): ?string
    {
        return $this->section;
    }

    public function setSection(?string $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->creaedBy;
    }

    public function setCreatedBy(?User $creaedBy): self
    {
        $this->creaedBy = $creaedBy;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
           // It is required that at least one field changes if you are using doctrine
           // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getFolderItem(): ?FolderItem
    {
        return $this->folderItem;
    }

    public function setFolderItem(?FolderItem $folderItem): self
    {
        $this->folderItem = $folderItem;

        return $this;
    }

    public function getExpenses(): ?Expenses
    {
        return $this->expenses;
    }

    public function setExpenses(?Expenses $expenses): self
    {
        $this->expenses = $expenses;

        return $this;
    }

    public function getSubvention(): ?Subvention
    {
        return $this->subvention;
    }

    public function setSubvention(?Subvention $subvention): self
    {
        $this->subvention = $subvention;

        return $this;
    }

    public function getSubventionDoc(): ?Subvention
    {
        return $this->subventionDoc;
    }

    public function setSubventionDoc(?Subvention $subventionDoc): self
    {
        $this->subventionDoc = $subventionDoc;

        return $this;
    }
}

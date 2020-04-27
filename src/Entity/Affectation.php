<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AffectationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Affectation
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="affectations")
     */
    private $affectedBy;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Folder", inversedBy="affectations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $folder;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sponsor", inversedBy="affectations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sponsor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ownAffectaions")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProposingTransaction", mappedBy="affectation")
     */
    private $proposingTransactions;

    public function __construct()
    {
        $this->proposingTransactions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Affectation N° : ' . $this->getId();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAffectedBy(): ?User
    {
        return $this->affectedBy;
    }

    public function setAffectedBy(?User $affectedBy): self
    {
        $this->affectedBy = $affectedBy;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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

    public function getSponsor(): ?Sponsor
    {
        return $this->sponsor;
    }

    public function setSponsor(?Sponsor $sponsor): self
    {
        $this->sponsor = $sponsor;

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
            $proposingTransaction->setAffectation($this);
        }

        return $this;
    }

    public function removeProposingTransaction(ProposingTransaction $proposingTransaction): self
    {
        if ($this->proposingTransactions->contains($proposingTransaction)) {
            $this->proposingTransactions->removeElement($proposingTransaction);
            // set the owning side to null (unless already changed)
            if ($proposingTransaction->getAffectation() === $this) {
                $proposingTransaction->setAffectation(null);
            }
        }

        return $this;
    }
}

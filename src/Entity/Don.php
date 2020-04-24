<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DonRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Don
{
  use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="dons")
     */
    private $Project;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Donor", inversedBy="dons", cascade={"persist"})
     */
    private $donor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeDon", inversedBy="don")
     */
    private $type;


    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $reciepe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="dons")
     */
    private $creaedBy;

  



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?Project
    {
        return $this->Project;
    }

    public function setProject(?Project $Project): self
    {
        $this->Project = $Project;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }



    public function getDonor(): ?Donor
    {
        return $this->donor;
    }

    public function setDonor(?Donor $donor): self
    {
        $this->donor = $donor;

        return $this;
    }

    public function addDonor(Donor $donor)
    {


        // for a many-to-one association:
        $donor->setDons($this);

        $this->donor->add($donor);
    }

    public function getType(): ?TypeDon
    {
        return $this->type;
    }

    public function setType(?TypeDon $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getReciepe(): ?bool
    {
        return $this->reciepe;
    }

    public function setReciepe(bool $reciepe): self
    {
        $this->reciepe = $reciepe;

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

    public function getCreaedBy(): ?User
    {
        return $this->creaedBy;
    }

    public function setCreaedBy(?User $creaedBy): self
    {
        $this->creaedBy = $creaedBy;

        return $this;
    }


}

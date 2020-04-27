<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProposingTransactionRepository")
 */
class ProposingTransaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime",  nullable=true)
     */
    private $transactionDate;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=0)
     */
    private $amount;

    /**
     * @ORM\Column(type="integer")
     */
    private $month;

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $recieved;

    /**
     * @ORM\Column(type="datetime",  nullable=true)
     */
    private $recievedDate;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="proposingTransactions")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="responsibleTransactions")
     */
    private $responsible;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Affectation", inversedBy="proposingTransactions", cascade={"persist"}))
     * @ORM\JoinColumn(nullable=false)
     */
    private $affectation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransactionDate(): ?\DateTimeInterface
    {
        return $this->transactionDate;
    }

    public function setTransactionDate(\DateTimeInterface $transactionDate): self
    {
        $this->transactionDate = $transactionDate;

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

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRecieved(): ?bool
    {
        return $this->recieved;
    }

    public function setRecieved(?bool $recieved): self
    {
        $this->recieved = $recieved;

        return $this;
    }

    public function getRecievedDate(): ?\DateTimeInterface
    {
        return $this->recievedDate;
    }

    public function setRecievedDate(\DateTimeInterface $recievedDate): self
    {
        $this->recievedDate = $recievedDate;

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

    public function getResponsible(): ?User
    {
        return $this->responsible;
    }

    public function setResponsible(?User $responsible): self
    {
        $this->responsible = $responsible;

        return $this;
    }

    public function getAffectation(): ?Affectation
    {
        return $this->affectation;
    }

    public function setAffectation(?Affectation $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }
}

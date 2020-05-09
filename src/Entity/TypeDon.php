<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeDonRepository")
 */
class TypeDon
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Don", mappedBy="type")
     */
    private $don;

    public function __construct()
    {
        $this->don = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Don[]
     */
    public function getDon(): Collection
    {
        return $this->don;
    }

    public function addDon(Don $don): self
    {
        if (!$this->don->contains($don)) {
            $this->don[] = $don;
            $don->setType($this);
        }

        return $this;
    }

    public function removeDon(Don $don): self
    {
        if ($this->don->contains($don)) {
            $this->don->removeElement($don);
            // set the owning side to null (unless already changed)
            if ($don->getType() === $this) {
                $don->setType(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\UniversityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniversityRepository::class)]
class University
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $localisation = null;

    #[ORM\OneToMany(mappedBy: 'univer', targetEntity: Studnet::class, orphanRemoval: true)]
    private Collection $studnets;

    public function __construct()
    {
        $this->studnets = new ArrayCollection();
    }

    public function getRef(): ?int
    {
        return $this->ref;
    }
    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Collection<int, Studnet>
     */
    public function getStudnets(): Collection
    {
        return $this->studnets;
    }

    public function addStudnet(Studnet $studnet): static
    {
        if (!$this->studnets->contains($studnet)) {
            $this->studnets->add($studnet);
            $studnet->setUniver($this);
        }

        return $this;
    }

    public function removeStudnet(Studnet $studnet): static
    {
        if ($this->studnets->removeElement($studnet)) {
            // set the owning side to null (unless already changed)
            if ($studnet->getUniver() === $this) {
                $studnet->setUniver(null);
            }
        }

        return $this;
    }
}

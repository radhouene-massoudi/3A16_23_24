<?php

namespace App\Entity;

use App\Repository\StudnetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudnetRepository::class)]
class Studnet
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $cin= null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'studnets')]
    #[ORM\JoinColumn(name:'ref_univ',referencedColumnName:'ref')]
    private ?University $univer = null;

    public function getCin(): ?int
    {
        return $this->cin;
    }
    public function setCin(string $cin): static
    {
        $this->cin = $cin;

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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUniver(): ?University
    {
        return $this->univer;
    }

    public function setUniver(?University $univer): static
    {
        $this->univer = $univer;

        return $this;
    }
}

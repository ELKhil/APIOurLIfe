<?php

namespace App\Entity;

use App\Repository\SchollBranchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SchollBranchRepository::class)]
class SchollBranch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $anacad = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnacad(): ?string
    {
        return $this->anacad;
    }

    public function setAnacad(string $anacad): static
    {
        $this->anacad = $anacad;

        return $this;
    }
}

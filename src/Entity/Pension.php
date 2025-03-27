<?php

namespace App\Entity;

use App\Repository\PensionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PensionRepository::class)]
class Pension
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_pension = null;

    #[ORM\Column]
    private ?int $Prix_pension = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPension(): ?string
    {
        return $this->Nom_pension;
    }

    public function setNomPension(string $Nom_pension): static
    {
        $this->Nom_pension = $Nom_pension;

        return $this;
    }

    public function getPrixPension(): ?string
    {
        return $this->Prix_pension;
    }

    public function setPrixPension(string $Prix_pension): static
    {
        $this->Prix_pension = $Prix_pension;

        return $this;
    }
}

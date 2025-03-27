<?php
// src/Entity/Nouriture.php

namespace App\Entity;

use App\Repository\NouritureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NouritureRepository::class)]
class Nouriture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_nouriture = null;

    #[ORM\Column]
    private ?int $Stock_dispo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomNouriture(): ?string
    {
        return $this->Nom_nouriture;
    }

    public function setNomNouriture(string $Nom_nouriture): static
    {
        $this->Nom_nouriture = $Nom_nouriture;

        return $this;
    }

    public function getStockDispo(): ?int
    {
        return $this->Stock_dispo;
    }

    public function setStockDispo(int $Stock_dispo): static
    {
        $this->Stock_dispo = $Stock_dispo;

        return $this;
    }

    public function __toString(): string
    {
        return $this->Nom_nouriture ?? '';
    }
}

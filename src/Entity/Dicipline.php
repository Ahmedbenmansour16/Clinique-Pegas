<?php

namespace App\Entity;

use App\Repository\DiciplineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiciplineRepository::class)]
class Dicipline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomDicipline = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDicipline(): ?string
    {
        return $this->nomDicipline;
    }

    public function setNomDicipline(string $nomDicipline): static
    {
        $this->nomDicipline = $nomDicipline;

        return $this;
    }
}

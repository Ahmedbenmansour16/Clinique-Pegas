<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprietaireRepository::class)]
class Proprietaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom_proprietaire = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom_proprietaire = null;

    #[ORM\Column]
    private ?int $Cin_proprietaire = null;

    #[ORM\Column]
    private ?int $Num_tel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProprietaire(): ?string
    {
        return $this->Nom_proprietaire;
    }

    public function setNomProprietaire(string $Nom_proprietaire): static
    {
        $this->Nom_proprietaire = $Nom_proprietaire;

        return $this;
    }

    public function getPrenomProprietaire(): ?string
    {
        return $this->Prenom_proprietaire;
    }

    public function setPrenomProprietaire(string $Prenom_proprietaire): static
    {
        $this->Prenom_proprietaire = $Prenom_proprietaire;

        return $this;
    }

    public function getCinProprietaire(): ?int
    {
        return $this->Cin_proprietaire;
    }

    public function setCinProprietaire(int $Cin_proprietaire): static
    {
        $this->Cin_proprietaire = $Cin_proprietaire;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->Num_tel;
    }

    public function setNumTel(int $Num_tel): static
    {
        $this->Num_tel = $Num_tel;

        return $this;
    }
}

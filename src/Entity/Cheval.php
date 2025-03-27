<?php

namespace App\Entity;

use App\Repository\ChevalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChevalRepository::class)]
class Cheval
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numPuce = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCheval = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $dateNaisse = null;

    #[ORM\Column(length: 50)]
    private ?string $genre = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proprietaire $proprietaire = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Dicipline $dicipline = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pension $pension = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $dateEntree = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nouriture $nourriture = null;

    #[ORM\Column]
    private ?int $paye = null;

    #[ORM\Column(nullable: true)]
    private ?int $restePaye = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $noteCheval = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
private ?string $rapportCheval = null;

    // Getters & Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumPuce(): ?string
    {
        return $this->numPuce;
    }

    public function setNumPuce(string $numPuce): static
    {
        $this->numPuce = $numPuce;
        return $this;
    }

    public function getNomCheval(): ?string
    {
        return $this->nomCheval;
    }

    public function setNomCheval(string $nomCheval): static
    {
        $this->nomCheval = $nomCheval;
        return $this;
    }

    public function getDateNaisse(): ?\DateTimeInterface
    {
        return $this->dateNaisse;
    }

    public function setDateNaisse(\DateTimeInterface $dateNaisse): static
    {
        $this->dateNaisse = $dateNaisse;
        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;
        return $this;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): static
    {
        $this->proprietaire = $proprietaire;
        return $this;
    }

    public function getDicipline(): ?Dicipline
    {
        return $this->dicipline;
    }

    public function setDicipline(?Dicipline $dicipline): static
    {
        $this->dicipline = $dicipline;
        return $this;
    }

    public function getPension(): ?Pension
    {
        return $this->pension;
    }

    public function setPension(?Pension $pension): static
    {
        $this->pension = $pension;
        return $this;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): static
    {
        $this->dateEntree = $dateEntree;
        return $this;
    }

    public function getNourriture(): ?Nouriture
    {
        return $this->nourriture;
    }

    public function setNourriture(?Nouriture $nourriture): static
    {
        $this->nourriture = $nourriture;
        return $this;
    }

    public function getPaye(): ?int
    {
        return $this->paye;
    }

    public function setPaye(int $paye): static
    {
        $this->paye = $paye;
        return $this;
    }

    public function getRestePaye(): ?int
    {
        return $this->restePaye;
    }

    public function setRestePaye(?int $restePaye): static
    {
        $this->restePaye = $restePaye;
        return $this;
    }

    public function getNoteCheval(): ?string
    {
        return $this->noteCheval;
    }

    public function setNoteCheval(?string $noteCheval): static
    {
        $this->noteCheval = $noteCheval;
        return $this;
    }

    public function getPhoto(): ?string
{
    return $this->photo;
}

public function setPhoto(?string $photo): static
{
    $this->photo = $photo;
    return $this;
}


public function getRapportCheval(): ?string
{
    return $this->rapportCheval;
}

public function setRapportCheval(?string $rapportCheval): static
{
    $this->rapportCheval = $rapportCheval;
    return $this;
}

}
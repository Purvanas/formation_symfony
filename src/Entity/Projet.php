<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $budget = null;

    #[ORM\Column]
    private ?float $seuilAlerte = null;

    #[ORM\Column(length: 255)]
    private ?string $plan = null;

    #[ORM\Column(length: 255)]
    private ?string $listeDiffusion = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\OneToMany(targetEntity: Facture::class, mappedBy: 'projet', cascade: ['persist', 'remove'])]
    private Collection $factures;

    #[ORM\OneToMany(targetEntity: AppelDeFond::class, mappedBy: 'projet', cascade: ['persist', 'remove'])]
    private Collection $appelDeFonds;

    #[ORM\OneToMany(targetEntity: BatchFormation::class, mappedBy: 'projet', cascade: ['persist', 'remove'])]
    private Collection $batchFormations;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
        $this->appelDeFonds = new ArrayCollection();
        $this->batchFormations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(float $budget): static
    {
        $this->budget = $budget;
        return $this;
    }

    public function getSeuilAlerte(): ?float
    {
        return $this->seuilAlerte;
    }

    public function setSeuilAlerte(float $seuilAlerte): static
    {
        $this->seuilAlerte = $seuilAlerte;
        return $this;
    }

    public function getPlan(): ?string
    {
        return $this->plan;
    }

    public function setPlan(string $plan): static
    {
        $this->plan = $plan;
        return $this;
    }

    public function getListeDiffusion(): ?string
    {
        return $this->listeDiffusion;
    }

    public function setListeDiffusion(string $listeDiffusion): static
    {
        $this->listeDiffusion = $listeDiffusion;
        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;
        return $this;
    }

    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function getAppelDeFonds(): Collection
    {
        return $this->appelDeFonds;
    }

    public function getBatchFormations(): Collection
    {
        return $this->batchFormations;
    }
}

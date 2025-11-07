<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $Cout = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFormation = null;

    #[ORM\Column]
    private ?float $tva = null;

    #[ORM\Column]
    private ?float $coutHT = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCout(): ?float
    {
        return $this->Cout;
    }

    public function setCout(float $Cout): static
    {
        $this->Cout = $Cout;

        return $this;
    }

    public function getDateFormation(): ?\DateTimeInterface
    {
        return $this->dateFormation;
    }

    public function setDateFormation(\DateTimeInterface $dateFormation): static
    {
        $this->dateFormation = $dateFormation;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): static
    {
        $this->tva = $tva;

        return $this;
    }

    public function getCoutHT(): ?float
    {
        return $this->coutHT;
    }

    public function setCoutHT(float $coutHT): static
    {
        $this->coutHT = $coutHT;

        return $this;
    }
}

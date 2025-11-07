<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $SIREN = null;

    #[ORM\Column(length: 255)]
    private ?string $IBAN = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $contactFacturation = null;

    /**
     * @var Collection<int, Comission>
     */
    #[ORM\OneToMany(targetEntity: Comission::class, mappedBy: 'client')]
    private Collection $idCommission;

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'idClient')]
    private Collection $projets;

    public function __construct()
    {
        $this->idCommission = new ArrayCollection();
        $this->projets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getSIREN(): ?string
    {
        return $this->SIREN;
    }

    public function setSIREN(string $SIREN): static
    {
        $this->SIREN = $SIREN;

        return $this;
    }

    public function getIBAN(): ?string
    {
        return $this->IBAN;
    }

    public function setIBAN(string $IBAN): static
    {
        $this->IBAN = $IBAN;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getContactFacturation(): ?string
    {
        return $this->contactFacturation;
    }

    public function setContactFacturation(string $contactFacturation): static
    {
        $this->contactFacturation = $contactFacturation;

        return $this;
    }

    /**
     * @return Collection<int, Comission>
     */
    public function getIdCommission(): Collection
    {
        return $this->idCommission;
    }

    public function addIdCommission(Comission $idCommission): static
    {
        if (!$this->idCommission->contains($idCommission)) {
            $this->idCommission->add($idCommission);
            $idCommission->setClient($this);
        }

        return $this;
    }

    public function removeIdCommission(Comission $idCommission): static
    {
        if ($this->idCommission->removeElement($idCommission)) {
            // set the owning side to null (unless already changed)
            if ($idCommission->getClient() === $this) {
                $idCommission->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setIdClient($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getIdClient() === $this) {
                $projet->setIdClient(null);
            }
        }

        return $this;
    }
}

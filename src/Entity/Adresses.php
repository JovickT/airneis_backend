<?php

namespace App\Entity;

use App\Repository\AdressesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


#[ORM\Entity(repositoryClass: AdressesRepository::class)]
class Adresses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['adresse'])]
    private ?int $id_adresse = null;

    #[ORM\Column(length: 50)]
    #[Groups(['adresse'])]
    private ?string $pays = null;

    #[ORM\Column(length: 50)]
    #[Groups(['adresse'])]
    private ?string $ville = null;

    #[ORM\Column(length: 8)]
    #[Groups(['adresse'])]
    private ?string $code_postal = null;

    #[ORM\Column(length: 100)]
    #[Groups(['adresse'])]
    private ?string $rue = null;

    public function getId(): ?int
    {
        return $this->id_adresse;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }
}

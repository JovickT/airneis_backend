<?php

namespace App\Entity;

use App\Repository\MateriauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MateriauxRepository::class)]
class Materiaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_materiel = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    public function getId(): ?int
    {
        return $this->id_materiel;
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
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PanierRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_panier = null;

    #[ORM\Column(type: 'json')]
    private ?array $lots = [];

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $date_creation;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $date_modification;

    #[ORM\Column(type: 'string', length: 20)]
    private string $etat = 'en cours';  // Ajout de la propriété `etat`

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'paniers')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id_client', nullable: false)]
    private ?Client $client = null;

    public function __construct()
    {
        $this->date_creation = new \DateTime();
        $this->date_modification = clone $this->date_creation;
        $this->etat = 'en cours';  // Initialisation par défaut de la propriété `etat`
    }

    public function getIdPanier(): ?int
    {
        return $this->id_panier;
    }

    public function getLots(): ?array
    {
        return $this->lots;
    }

    public function setLots(array $lots): self
    {
        $this->lots = $lots;

        return $this;
    }

    public function getDateCreation(): \DateTimeInterface
    {
        return $this->date_creation;
    }

    public function getDateModification(): \DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getEtat(): string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;
        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}

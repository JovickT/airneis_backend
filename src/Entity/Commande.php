<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_commande = null;

    #[ORM\Column(length: 8, unique: true)]
    #[Assert\Regex("/^COM[0-9A-Za-z]{5}$/")]
    private ?string $reference = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(name: "id_client", referencedColumnName: "id_client")]
    private ?Client $client = null;

    #[ORM\ManyToOne(targetEntity: Panier::class)]
    #[ORM\JoinColumn(name: "id_panier", referencedColumnName: "id_panier")]
    private ?Panier $panier = null;

    #[ORM\ManyToOne(targetEntity: Adresses::class)]
    #[ORM\JoinColumn(name: "id_adresse", referencedColumnName: "id_adresse")]
    private ?Adresses $adresse = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $date_commande;

    #[ORM\Column(length: 20)]
    private ?string $etat = null;

    public function __construct()
    {
        $this->date_commande = new \DateTime();
        $this->etat = 'En cours'; // Valeur par défaut
    }

    public function getIdCommande(): ?int
    {
        return $this->id_commande;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;
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

    public function getPanier(): ?Panier
    {
        return $this->panier;
    }

    public function setPanier(?Panier $panier): self
    {
        $this->panier = $panier;
        return $this;
    }

    public function getAdresse(): ?Adresses
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresses $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getDateCommande(): \DateTimeInterface
    {
        return $this->date_commande;
    }

    public function setDateCommande(\DateTimeInterface $date_commande): self
    {
        $this->date_commande = $date_commande;
        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;
        return $this;
    }
}

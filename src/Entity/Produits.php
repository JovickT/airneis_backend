<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_produit = null;

    #[ORM\Column(length: 15)]
    private ?string $reference = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\ManyToOne(targetEntity: Marques::class)]
    #[ORM\JoinColumn(name: "marque", referencedColumnName: "id")]
    private ?Marques $marque = null;

    #[ORM\ManyToOne(targetEntity: Categories::class)]
    #[ORM\JoinColumn(name: "categorie", referencedColumnName: "id_categorie")]
    private ?Categories $categorie = null;

    #[ORM\ManyToOne(targetEntity: Materiaux::class)]
    #[ORM\JoinColumn(name: "materiaux", referencedColumnName: "id_materiel")]
    private ?Materiaux $materiaux = null;

    #[ORM\OneToMany(targetEntity: ImageProduit::class, mappedBy: 'produit')]
    private Collection $produitImages;

    public function __construct()
    {
        $this->produitImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id_produit;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;
        return $this;
    }

    public function getMarque(): ?Marques
    {
        return $this->marque;
    }

    public function setMarque(?Marques $marque): self
    {
        $this->marque = $marque;
        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }

    public function getMateriaux(): ?Materiaux
    {
        return $this->materiaux;
    }

    public function setMateriaux(?Materiaux $materiaux): self
    {
        $this->materiaux = $materiaux;
        return $this;
    }

    /**
     * @return Collection<int, ImageProduit>
     */
    public function getProduitImages(): Collection
    {
        return $this->produitImages;
    }

    public function addProduitImage(ImageProduit $produitImage): self
    {
        if (!$this->produitImages->contains($produitImage)) {
            $this->produitImages->add($produitImage);
            $produitImage->setProduit($this);
        }
        return $this;
    }

    public function removeProduitImage(ImageProduit $produitImage): self
    {
        if ($this->produitImages->removeElement($produitImage)) {
            // set the owning side to null (unless already changed)
            if ($produitImage->getProduit() === $this) {
                $produitImage->setProduit(null);
            }
        }
        return $this;
    }
}
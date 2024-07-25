<?php

// src/Entity/ImageProduit.php

namespace App\Entity;

use App\Repository\ImageProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageProduitRepository::class)]
class ImageProduit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_image_produit = null;

    #[ORM\ManyToOne(targetEntity: Image::class, inversedBy: 'imageProduits')]
    #[ORM\JoinColumn(nullable: false, name: 'id_image', referencedColumnName: 'id_image')]
    private ?Image $image = null;

    #[ORM\ManyToOne(targetEntity: Produits::class, inversedBy: 'produitImages')]
    #[ORM\JoinColumn(nullable: false, name: 'id_produit', referencedColumnName: 'id_produit')]
    private ?Produits $produit = null;

    public function getIdImageProduit(): ?int
    {
        return $this->id_image_produit;
    }

    public function getProduit(): ?Produits
    {
        return $this->produit;
    }

    public function setProduit(?Produits $produit): self
    {
        $this->produit = $produit;
        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;
        return $this;
    }
}
<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id_image = null;

    #[ORM\Column(length: 40)]
    private ?string $nom = null;


    #[ORM\Column(length: 255)]
    private ?string $lien = null;

    #[ORM\OneToMany(targetEntity: ImageProduit::class, mappedBy: 'image')]
    private Collection $imageProduits;

    public function __construct()
    {
        $this->imageProduits = new ArrayCollection();
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

    public function getIdImage(): ?int
    {
        return $this->id_image;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;
        return $this;
    }

    /**
     * @return Collection<int, ImageProduit>
     */
    public function getImageProduits(): Collection
    {
        return $this->imageProduits;
    }

    public function addImageProduit(ImageProduit $imageProduit): self
    {
        if (!$this->imageProduits->contains($imageProduit)) {
            $this->imageProduits->add($imageProduit);
            $imageProduit->setImage($this);
        }
        return $this;
    }

    public function removeImageProduit(ImageProduit $imageProduit): self
    {
        if ($this->imageProduits->removeElement($imageProduit)) {
            // set the owning side to null (unless already changed)
            if ($imageProduit->getImage() === $this) {
                $imageProduit->setImage(null);
            }
        }
        return $this;
    }
}
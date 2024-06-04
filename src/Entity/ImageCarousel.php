<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImageCarouselRepository;

#[ORM\Entity(repositoryClass: ImageCarouselRepository::class)]
class ImageCarousel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Carrousel::class)]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: "id")]
    private ?Carrousel $carrousel = null;

    #[ORM\ManyToOne(targetEntity: Image::class)]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: "id_image")]
    private ?Image $image = null;

    #[ORM\Column]
    private ?int $rang = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarrousel(): ?Carrousel
    {
        return $this->carrousel;
    }

    public function setCarrousel(?Carrousel $carrousel): static
    {
        $this->carrousel = $carrousel;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getRang(): ?int
    {
        return $this->rang;
    }

    public function setRang(int $rang): static
    {
        $this->rang = $rang;

        return $this;
    }
}

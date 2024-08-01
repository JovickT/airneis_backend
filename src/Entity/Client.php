<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Client implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_client = null;

    #[ORM\Column(length: 40)]
    private ?string $prenom = null;

    #[ORM\Column(length: 40)]
    private ?string $nom = null;

    #[ORM\Column(length: 80, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?array $roles = null;

    #[ORM\Column]
    private ?string $mot_de_passe = null;

    #[ORM\Column(length: 15)]
    private ?string $telephone = '';

    #[ORM\ManyToMany(targetEntity: Adresses::class, cascade: ["persist"])]
    #[ORM\JoinTable(name: "client_adresse",
        joinColumns: [new ORM\JoinColumn(name: "client_id", referencedColumnName: "id_client")],
        inverseJoinColumns: [new ORM\JoinColumn(name: "adresse_id", referencedColumnName: "id_adresse")]
    )]
    private Collection $adresses;

    // #[ORM\ManyToOne(targetEntity: Panier::class)]
    // #[ORM\JoinColumn(name: "panier_en_cours_id", referencedColumnName: "id_panier", nullable: true)]
    // private ?Panier $panierEnCours = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Panier::class, cascade: ['persist', 'remove'])]
    private Collection $paniers;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: PaymentMethod::class, cascade: ['persist', 'remove'])]
    private Collection $paymentMethods;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $stripeCustomerId = null;
    
    public function __construct()
    {
        $this->adresses = new ArrayCollection();
        $this->paniers = new ArrayCollection(); // Initialisation de la collection de paniers
        $this->paymentMethods = new ArrayCollection(); // Initialisation de la collection de moyens de paiement
    }

    public function getIdClient(): ?int
    {
        return $this->id_client;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setPassword(string $mot_de_passe): static
    {
        $this->mot_de_passe = $mot_de_passe;
        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdresse(Adresses $adresse): self
    {
        if (!$this->adresses->contains($adresse)) {
            $this->adresses->add($adresse);
        }

        return $this;
    }

    public function removeAdresse(Adresses $adresse): self
    {
        $this->adresses->removeElement($adresse);

        return $this;
    }

    // public function getPanierEnCours(): ?Panier
    // {
    //     return $this->panierEnCours;
    // }

    // public function setPanierEnCours(?Panier $panierEnCours): self
    // {
    //     $this->panierEnCours = $panierEnCours;

    //     return $this;
    // }

    public function getPaniers(): Collection
    {
        return $this->paniers;
    }

    public function addPanier(Panier $panier): self
    {
        if (!$this->paniers->contains($panier)) {
            $this->paniers->add($panier);
            $panier->setClient($this);
        }

        return $this;
    }

    public function removePanier(Panier $panier): self
    {
        if ($this->paniers->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getClient() === $this) {
                $panier->setClient(null);
            }
        }

        return $this;
    }

    public function eraseCredentials(): void
    {
        // Effacer les informations sensibles (comme le mot de passe)
    }

    public function getRoles(): array
    {
        $roles = $this->roles ?? [];
        if ($this->roles === null) {
            $this->roles = ['ROLE_USER'];
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

        public function getPaymentMethods(): Collection
    {
        return $this->paymentMethods;
    }

    public function addPaymentMethod(PaymentMethod $paymentMethod): self
    {
        if (!$this->paymentMethods->contains($paymentMethod)) {
            $this->paymentMethods->add($paymentMethod);
            $paymentMethod->setClient($this);
        }

        return $this;
    }

    public function removePaymentMethod(PaymentMethod $paymentMethod): self
    {
        if ($this->paymentMethods->removeElement($paymentMethod)) {
            // set the owning side to null (unless already changed)
            if ($paymentMethod->getClient() === $this) {
                $paymentMethod->setClient(null);
            }
        }

        return $this;

    }

    public function getStripeCustomerId(): ?string
    {
        return $this->stripeCustomerId;
    }

    public function setStripeCustomerId(?string $stripeCustomerId): self
    {
        $this->stripeCustomerId = $stripeCustomerId;

        return $this;
    }

}

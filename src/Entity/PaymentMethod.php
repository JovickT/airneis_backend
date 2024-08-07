<?php

namespace App\Entity;

use App\Repository\PaymentMethodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentMethodRepository::class)
 * @ORM\Table(name="payment_method")
 */
#[ORM\Entity(repositoryClass: PaymentMethodRepository::class)]
#[ORM\Table(name: 'payment_method')]
class PaymentMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $stripePaymentMethodId = null;

    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private ?string $last4 = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $brand = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $expMonth = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $expYear = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'paymentMethods')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id_client', nullable: true)]
    private ?Client $client = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $etat = false;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStripePaymentMethodId(): ?string
    {
        return $this->stripePaymentMethodId;
    }

    public function setStripePaymentMethodId(string $stripePaymentMethodId): self
    {
        $this->stripePaymentMethodId = $stripePaymentMethodId;

        return $this;
    }

    public function getLast4(): ?string
    {
        return $this->last4;
    }

    public function setLast4(?string $last4): self
    {
        $this->last4 = $last4;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getExpMonth(): ?int
    {
        return $this->expMonth;
    }

    public function setExpMonth(?int $expMonth): self
    {
        $this->expMonth = $expMonth;

        return $this;
    }

    public function getExpYear(): ?int
    {
        return $this->expYear;
    }

    public function setExpYear(?int $expYear): self
    {
        $this->expYear = $expYear;

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

    public function getEtat(): bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}

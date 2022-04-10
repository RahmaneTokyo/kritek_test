<?php

namespace App\Entity;

use App\Repository\InvoicelinesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoicelinesRepository::class)]
class Invoicelines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2, nullable: true)]
    private $amount;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2, nullable: true)]
    private $VAT_amount;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2)]
    private $Total;

    #[ORM\ManyToOne(targetEntity: Invoice::class, inversedBy: 'invoicelines')]
    private $invoice;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getVATAmount(): ?string
    {
        return $this->VAT_amount;
    }

    public function setVATAmount(string $VAT_amount): self
    {
        $this->VAT_amount = $VAT_amount;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->Total;
    }

    public function setTotal(string $Total): self
    {
        $this->Total = $Total;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(?Invoice $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }
}

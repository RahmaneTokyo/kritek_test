<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $invoice_date;

    #[ORM\Column(type: 'integer')]
    private $invoice_number;

    #[ORM\Column(type: 'integer')]
    private $customer_id;

    #[ORM\OneToMany(mappedBy: 'invoice', targetEntity: Invoicelines::class, cascade: ["persist"])]
    private $invoicelines;

    public function __construct()
    {
        $this->invoicelines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoice_date;
    }

    public function setInvoiceDate(\DateTimeInterface $invoice_date): self
    {
        $this->invoice_date = $invoice_date;

        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoice_number;
    }

    public function setInvoiceNumber(int $invoice_number): self
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    public function getCustomerId(): ?int
    {
        return $this->customer_id;
    }

    public function setCustomerId(int $customer_id): self
    {
        $this->customer_id = $customer_id;

        return $this;
    }

    /**
     * @return Collection<int, Invoicelines>
     */
    public function getInvoicelines(): Collection
    {
        return $this->invoicelines;
    }

    public function addInvoiceline(Invoicelines $invoiceline): self
    {
        if (!$this->invoicelines->contains($invoiceline)) {
            $this->invoicelines[] = $invoiceline;
            $invoiceline->setInvoice($this);
        }

        return $this;
    }

    public function removeInvoiceline(Invoicelines $invoiceline): self
    {
        if ($this->invoicelines->removeElement($invoiceline)) {
            // set the owning side to null (unless already changed)
            if ($invoiceline->getInvoice() === $this) {
                $invoiceline->setInvoice(null);
            }
        }

        return $this;
    }
}

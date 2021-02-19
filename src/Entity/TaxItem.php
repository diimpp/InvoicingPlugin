<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

/** @final */
class TaxItem implements TaxItemInterface, ResourceInterface
{
    /** @var int|null */
    protected $id;

    /** @var InvoiceInterface */
    protected $invoice;

    /** @var string */
    protected $label;

    /** @var int */
    protected $amount;

    public function __construct(string $label, int $amount)
    {
        $this->label = $label;
        $this->amount = $amount;
    }

    public function getId(): ?int
    {
        return $this->id();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function invoice(): InvoiceInterface
    {
        return $this->invoice;
    }

    public function setInvoice(InvoiceInterface $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function amount(): int
    {
        return $this->amount;
    }
}

<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface TaxItemInterface extends ResourceInterface
{
    public function id(): string;

    public function invoice(): InvoiceInterface;

    public function setInvoice(InvoiceInterface $invoice): void;

    public function label(): string;

    public function amount(): int;
}

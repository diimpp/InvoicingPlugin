<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Factory;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\InvoicingPlugin\Entity\TaxItemInterface;

interface TaxItemFactoryInterface extends FactoryInterface
{
    public function createForData(
        string $name,
        int $quantity,
        int $unitPrice,
        int $subtotal,
        int $taxTotal,
        int $total,
        ?string $variantName = null,
        ?string $variantCode = null
    ): TaxItemInterface;
}

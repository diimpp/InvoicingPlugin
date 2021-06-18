<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Factory;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\InvoicingPlugin\Entity\TaxItemInterface;

interface TaxItemFactoryInterface extends FactoryInterface
{
    public function createForData(string $label, int $amount): TaxItemInterface;
}

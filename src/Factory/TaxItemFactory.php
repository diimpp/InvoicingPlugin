<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Factory;

use Sylius\InvoicingPlugin\Entity\TaxItemInterface;

final class TaxItemFactory implements TaxItemFactoryInterface
{
    /**
     * @var string
     * @psalm-var class-string
     */
    private $className;

    /**
     * @psalm-param class-string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function createNew(): TaxItemInterface
    {
        throw new \InvalidArgumentException('This object is not default constructable.');
    }

    public function createForData(
        string $name,
        int $quantity,
        int $unitPrice,
        int $subtotal,
        int $taxTotal,
        int $total,
        ?string $variantName = null,
        ?string $variantCode = null
    ): TaxItemInterface {
        return new $this->className(
            $name,
            $quantity,
            $unitPrice,
            $subtotal,
            $taxTotal,
            $total,
            $variantName,
            $variantCode
        );
    }
}

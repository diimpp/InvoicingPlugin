<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Factory;

use Sylius\Component\Resource\Exception\UnsupportedMethodException;
use Sylius\InvoicingPlugin\Entity\LineItemInterface;

final class LineItemFactory implements LineItemFactoryInterface
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

    /** @throws UnsupportedMethodException */
    public function createNew(): LineItemInterface
    {
        throw new UnsupportedMethodException('createNew');
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
    ): LineItemInterface {
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

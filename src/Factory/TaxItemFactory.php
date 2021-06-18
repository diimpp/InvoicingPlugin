<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Factory;

use Sylius\Component\Resource\Exception\UnsupportedMethodException;
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

    /** @throws UnsupportedMethodException */
    public function createNew(): TaxItemInterface
    {
        throw new UnsupportedMethodException('createNew');
    }

    public function createForData(string $label, int $amount): TaxItemInterface
    {
        return new $this->className($label, $amount);
    }
}

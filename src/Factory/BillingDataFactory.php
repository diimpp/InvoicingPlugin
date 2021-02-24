<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Factory;

use Sylius\InvoicingPlugin\Entity\BillingDataInterface;

final class BillingDataFactory implements BillingDataFactoryInterface
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

    public function createNew(): BillingDataInterface
    {
        throw new \InvalidArgumentException('This object is not default constructable.');
    }

    public function createForData(
        string $firstName,
        string $lastName,
        string $countryCode,
        string $street,
        string $city,
        string $postcode,
        ?string $provinceCode = null,
        ?string $provinceName = null,
        ?string $company = null
    ): BillingDataInterface {
        return new $this->className(
            $firstName,
            $lastName,
            $countryCode,
            $street,
            $city,
            $postcode,
            $provinceCode,
            $provinceName,
            $company
        );
    }
}

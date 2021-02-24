<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Factory;

use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\InvoicingPlugin\Entity\BillingDataInterface;

interface BillingDataFactoryInterface extends FactoryInterface
{
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
    ): BillingDataInterface;
}

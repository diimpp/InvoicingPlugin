<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Converter;

use Sylius\Component\Core\Model\AddressInterface;
use Sylius\InvoicingPlugin\Entity\BillingData;
use Sylius\InvoicingPlugin\Entity\BillingDataInterface;
use Sylius\InvoicingPlugin\Factory\BillingDataFactoryInterface;

final class BillingDataConverter implements BillingDataConverterInterface
{
    /** @var BillingDataFactoryInterface */
    private $billingDataFactory;

    public function __construct(BillingDataFactoryInterface $billingDataFactory)
    {
        $this->billingDataFactory = $billingDataFactory;
    }

    public function convert(AddressInterface $billingAddress): BillingDataInterface
    {
        return $this->billingDataFactory->createForData(
            $billingAddress->getFirstName(),
            $billingAddress->getLastName(),
            $billingAddress->getCountryCode(),
            $billingAddress->getStreet(),
            $billingAddress->getCity(),
            $billingAddress->getPostcode(),
            $billingAddress->getProvinceCode(),
            $billingAddress->getProvinceName(),
            $billingAddress->getCompany()
        );
    }
}

<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Converter;

use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ShopBillingDataInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\InvoicingPlugin\Entity\InvoiceShopBillingData;
use Sylius\InvoicingPlugin\Entity\InvoiceShopBillingDataInterface;

final class InvoiceShopBillingDataConverter implements InvoiceShopBillingDataConverterInterface
{
    /** @var FactoryInterface */
    private $shopBillingDataFactory;

    public function __construct(FactoryInterface $shopBillingDataFactory)
    {
        $this->shopBillingDataFactory = $shopBillingDataFactory;
    }

    public function convert(ChannelInterface $channel): InvoiceShopBillingDataInterface
    {
        /** @var ShopBillingDataInterface|null $shopBillingData */
        $shopBillingData = $channel->getShopBillingData();

        $invoiceShopBillingData = $this->shopBillingDataFactory->createNew();

        if (null === $shopBillingData) {
            return $invoiceShopBillingData;
        }

        $invoiceShopBillingData->setCompany($shopBillingData->getCompany());
        $invoiceShopBillingData->setTaxId($shopBillingData->getTaxId());
        $invoiceShopBillingData->setCountryCode($shopBillingData->getCountryCode());
        $invoiceShopBillingData->setStreet($shopBillingData->getStreet());
        $invoiceShopBillingData->setCity($shopBillingData->getCity());
        $invoiceShopBillingData->setPostcode($shopBillingData->getPostcode());

        return $invoiceShopBillingData;
    }
}

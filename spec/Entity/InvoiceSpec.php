<?php

declare(strict_types=1);

namespace spec\Sylius\InvoicingPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\InvoicingPlugin\Entity\BillingDataInterface;
use Sylius\InvoicingPlugin\Entity\InvoiceInterface;
use Sylius\InvoicingPlugin\Entity\InvoiceShopBillingDataInterface;
use Sylius\InvoicingPlugin\Entity\LineItemInterface;
use Sylius\InvoicingPlugin\Entity\TaxItemInterface;

final class InvoiceSpec extends ObjectBehavior
{
    function let(
        BillingDataInterface $billingData,
        LineItemInterface $lineItem,
        TaxItemInterface $taxItem,
        ChannelInterface $channel,
        InvoiceShopBillingDataInterface $shopBillingData
    ): void {
        $issuedAt = new \DateTimeImmutable('2019-01-23 15:45:30');

        $this->beConstructedWith(
            '7903c83a-4c5e-4bcf-81d8-9dc304c6a353',
            '2019/01/000000001',
            '007',
            $issuedAt,
            $billingData,
            'USD',
            'en_US',
            10300,
            new ArrayCollection([$lineItem->getWrappedObject()]),
            new ArrayCollection([$taxItem->getWrappedObject()]),
            $channel,
            $shopBillingData
        );
    }

    function it_implements_invoice_interface(): void
    {
        $this->shouldImplement(InvoiceInterface::class);
    }

    function it_implements_resource_interface(): void
    {
        $this->shouldImplement(ResourceInterface::class);
    }

    function it_has_id(): void
    {
        $this->getId()->shouldReturn('7903c83a-4c5e-4bcf-81d8-9dc304c6a353');
        $this->id()->shouldReturn('7903c83a-4c5e-4bcf-81d8-9dc304c6a353');
    }

    function it_has_a_number(): void
    {
        $this->number()->shouldReturn('2019/01/000000001');
    }

    function it_has_an_order_number(): void
    {
        $this->orderNumber()->shouldReturn('007');
    }

    function it_has_a_date_of_issuing(): void
    {
        $this->issuedAt()->shouldBeLike(new \DateTimeImmutable('2019-01-23 15:45:30'));
    }

    function it_has_a_billing_data(BillingDataInterface $billingData): void
    {
        $this->billingData()->shouldBeLike($billingData);
    }

    function it_has_a_currency_code(): void
    {
        $this->currencyCode()->shouldReturn('USD');
    }

    function it_has_a_locale_code(): void
    {
        $this->localeCode()->shouldReturn('en_US');
    }

    function it_has_total(): void
    {
        $this->total()->shouldReturn(10300);
    }

    function it_has_line_items(LineItemInterface $lineItem): void
    {
        $this->lineItems()->shouldBeLike(new ArrayCollection([$lineItem->getWrappedObject()]));
    }

    function it_has_tax_items(TaxItemInterface $taxItem): void
    {
        $this->taxItems()->shouldBeLike(new ArrayCollection([$taxItem->getWrappedObject()]));
    }

    function it_has_a_channel(ChannelInterface $channel): void
    {
        $this->channel()->shouldReturn($channel);
    }

    function it_has_a_shop_billing_data(InvoiceShopBillingDataInterface $shopBillingData): void
    {
        $this->shopBillingData()->shouldBeLike($shopBillingData);
    }
}

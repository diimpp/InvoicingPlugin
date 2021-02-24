<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Converter;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\InvoicingPlugin\Entity\TaxItem;
use Sylius\InvoicingPlugin\Factory\TaxItemFactoryInterface;
use Webmozart\Assert\Assert;

final class TaxItemsConverter implements TaxItemsConverterInterface
{
    /** @var TaxItemFactoryInterface */
    private $taxItemFactory;

    public function __construct(TaxItemFactoryInterface $taxItemFactory)
    {
        $this->taxItemFactory = $taxItemFactory;
    }

    public function convert(OrderInterface $order): Collection
    {
        $temporaryTaxItems = [];
        $taxItems = new ArrayCollection();

        $taxAdjustments = $order->getAdjustmentsRecursively(AdjustmentInterface::TAX_ADJUSTMENT);
        foreach ($taxAdjustments as $taxAdjustment) {
            $taxAdjustmentLabel = $taxAdjustment->getLabel();

            Assert::notNull($taxAdjustmentLabel);

            if (array_key_exists($taxAdjustmentLabel, $temporaryTaxItems)) {
                $temporaryTaxItems[$taxAdjustmentLabel] += $taxAdjustment->getAmount();

                continue;
            }

            $temporaryTaxItems[$taxAdjustmentLabel] = $taxAdjustment->getAmount();
        }

        foreach ($temporaryTaxItems as $label => $amount) {
            $taxItems->add($this->lineItemFactory->createForData($label, $amount));
        }

        return $taxItems;
    }
}

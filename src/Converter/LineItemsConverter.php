<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Converter;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\InvoicingPlugin\Factory\LineItemFactoryInterface;

final class LineItemsConverter implements LineItemsConverterInterface
{
    /** @var LineItemFactoryInterface */
    private $lineItemFactory;

    public function __construct(LineItemFactoryInterface $lineItemFactory)
    {
        $this->lineItemFactory = $lineItemFactory;
    }

    public function convert(OrderInterface $order): Collection
    {
        $orderItems = $order->getItems();
        $shippingAdjustments = $order->getAdjustments(AdjustmentInterface::SHIPPING_ADJUSTMENT);
        $lineItems = new ArrayCollection();

        /** @var OrderItemInterface $orderItem */
        foreach ($orderItems as $orderItem) {
            $variant = $orderItem->getVariant();

            $lineItems->add($this->lineItemFactory->createForData(
                $orderItem->getProductName(),
                $orderItem->getQuantity(),
                $orderItem->getUnitPrice(),
                $orderItem->getSubtotal(),
                $orderItem->getTaxTotal(),
                $orderItem->getTotal(),
                $orderItem->getVariantName(),
                $variant !== null ? $variant->getCode() : null
            ));
        }

        /** @var AdjustmentInterface $shippingAdjustment */
        foreach ($shippingAdjustments as $shippingAdjustment) {
            $lineItems->add($this->lineItemFactory->createForData(
                $shippingAdjustment->getLabel(),
                1,
                $shippingAdjustment->getAmount(),
                $shippingAdjustment->getAmount(),
                0,
                $shippingAdjustment->getAmount()
            ));
        }

        return $lineItems;
    }
}

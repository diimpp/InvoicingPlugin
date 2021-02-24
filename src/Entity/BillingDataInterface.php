<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface BillingDataInterface extends ResourceInterface
{
    public function id(): int;

    public function firstName(): string;

    public function lastName(): string;

    public function countryCode(): string;

    public function street(): string;

    public function city(): string;

    public function postcode(): string;

    public function provinceCode(): ?string;

    public function provinceName(): ?string;

    public function company(): ?string;
}

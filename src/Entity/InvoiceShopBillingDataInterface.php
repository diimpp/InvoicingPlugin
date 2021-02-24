<?php

declare(strict_types=1);

namespace Sylius\InvoicingPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;

interface InvoiceShopBillingDataInterface extends ResourceInterface
{
    public function getId(): string;

    public function getTaxId(): ?string;

    public function getCompany(): ?string;

    public function getCountryCode(): ?string;

    public function getStreet(): ?string;

    public function getCity(): ?string;

    public function getPostcode(): ?string;

    public function getRepresentative(): ?string;

    public function setCompany(?string $company): void;

    public function setTaxId(?string $taxId): void;

    public function setCountryCode(?string $countryCode): void;

    public function setStreet(?string $street): void;

    public function setCity(?string $city): void;

    public function setPostcode(?string $postcode): void;

    public function setRepresentative(?string $representative): void;
}

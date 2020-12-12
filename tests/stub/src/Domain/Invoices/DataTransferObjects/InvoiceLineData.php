<?php

namespace Stub\Domain\Invoices\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class InvoiceLineData extends DataTransferObject
{
    public string $description;

    public int $itemAmount;

    public int $itemPrice;

    public int $vatPercentage;

    public int $totalPriceExcludingVat;

    public int $totalPriceIncludingVat;
}

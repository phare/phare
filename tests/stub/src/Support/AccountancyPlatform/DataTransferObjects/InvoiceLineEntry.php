<?php

namespace Stub\Support\AccountancyPlatform\DataTransferObjects;

use Stub\Domain\Invoices\Models\InvoiceLine;
use Spatie\DataTransferObject\DataTransferObject;

class InvoiceLineEntry extends DataTransferObject
{
    public string $description;

    public int $itemAmount;

    public int $itemPrice;

    public int $vatPercentage;

    public static function fromInvoiceLine(InvoiceLine $invoiceLine): self
    {
        return new self([
            'description' => $invoiceLine->description,
            'itemAmount' => $invoiceLine->item_amount,
            'itemPrice' => $invoiceLine->item_price,
            'vatPercentage' => $invoiceLine->vat_percentage,
        ]);
    }
}

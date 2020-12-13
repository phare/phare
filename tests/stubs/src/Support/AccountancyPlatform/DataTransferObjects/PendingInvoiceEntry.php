<?php

namespace Stub\Support\AccountancyPlatform\DataTransferObjects;

use Stub\Domain\Invoices\Models\Invoice;
use Stub\Domain\Invoices\Models\InvoiceLine;
use Spatie\DataTransferObject\DataTransferObject;

class PendingInvoiceEntry extends DataTransferObject
{
    public string $number;

    public int $totalPrice;

    public array $lines;

    public static function fromInvoice(Invoice $invoice): self
    {
        return new self([
            'number' => $invoice->number,
            'totalPrice' => $invoice->total_price,
            'lines' => $invoice->invoiceLines->map(
                fn(InvoiceLine $invoiceLine) => InvoiceLineEntry::fromInvoiceLine($invoiceLine)
            ),
        ]);
    }
}

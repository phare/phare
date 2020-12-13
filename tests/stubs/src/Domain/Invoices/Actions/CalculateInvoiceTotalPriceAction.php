<?php

namespace Stub\Domain\Invoices\Actions;

use Stub\Domain\Invoices\DataTransferObjects\InvoiceLineData;
use Stub\Domain\Invoices\Models\Invoice;

class CalculateInvoiceTotalPriceAction
{
    public function __invoke(Invoice $invoice): int
    {
        return $invoice
            ->invoiceLines
            ->sum(fn (InvoiceLineData $invoiceLine) => $invoiceLine->totalPriceIncludingVat);
    }
}

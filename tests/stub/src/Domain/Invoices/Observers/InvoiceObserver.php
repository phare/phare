<?php

namespace Stub\Domain\Invoices\Observers;

use Stub\Domain\Invoices\Models\Invoice;
use Stub\Domain\Invoices\Models\InvoiceLine;

class InvoiceObserver
{
    public function saving(Invoice $invoice): void
    {
        $invoice->total_price = $invoice->invoiceLines
            ->sum(fn(InvoiceLine $invoiceLine) => $invoiceLine->total_price);
    }
}

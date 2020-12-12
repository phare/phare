<?php

namespace Stub\Domain\Invoices\Events;

use Stub\Domain\Invoices\Models\Invoice;

class InvoiceSavingEvent
{
    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}

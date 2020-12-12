<?php

namespace Stub\Domain\Invoices\Actions;

use Stub\Domain\Invoices\Models\Invoice;
use Stub\Domain\Invoices\States\Paid;

class PayInvoiceAction
{
    public function __invoke(Invoice $invoice): void
    {
        $invoice->status->transitionTo(Paid::class);
    }
}

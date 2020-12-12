<?php

namespace Stub\Domain\Invoices\Collections;

use Stub\Domain\Invoices\Models\InvoiceLine;
use Illuminate\Database\Eloquent\Collection;

class InvoiceLineCollection extends Collection
{
    public function onlyNegatives(): self
    {
        return $this->filter(
            fn(InvoiceLine $invoiceLine) => $invoiceLine->total_price_including_vat < 0
        );
    }
}

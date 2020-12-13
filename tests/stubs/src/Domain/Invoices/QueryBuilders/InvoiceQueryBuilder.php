<?php

namespace Stub\Domain\Invoices\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class InvoiceQueryBuilder extends Builder
{
    public function latestNumber(): string
    {
        $firstInvoice = $this
            ->orderByDesc('number')
            ->select('number')
            ->limit(1)
            ->first();

        if (! $firstInvoice) {
            return '000';
        }

        return $firstInvoice->getAttribute('number');
    }
}

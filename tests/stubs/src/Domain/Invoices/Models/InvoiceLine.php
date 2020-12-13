<?php

namespace Stub\Domain\Invoices\Models;

use Stub\Domain\Invoices\Collections\InvoiceLineCollection;
use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model
{
    public function newCollection(array $models = []): InvoiceLineCollection
    {
        return new InvoiceLineCollection($models);
    }
}

<?php

namespace Stub\Domain\Invoices\States;

class Cancelled extends InvoiceState
{
    public function getColour(): string
    {
        return 'gray';
    }

    public function shouldBePaid(): bool
    {
        return false;
    }
}

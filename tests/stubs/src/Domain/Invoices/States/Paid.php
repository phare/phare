<?php

namespace Stub\Domain\Invoices\States;

class Paid extends InvoiceState
{
    public function getColour(): string
    {
        return 'green';
    }

    public function shouldBePaid(): bool
    {
        return false;
    }
}

<?php

namespace Stub\Domain\Invoices\States;

class Pending extends InvoiceState
{
    public function getColour(): string
    {
        return 'white';
    }

    public function shouldBePaid(): bool
    {
        return true;
    }
}

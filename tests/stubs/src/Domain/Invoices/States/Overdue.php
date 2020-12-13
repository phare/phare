<?php

namespace Stub\Domain\Invoices\States;

class Overdue extends InvoiceState
{
    public function getColour(): string
    {
        return 'red';
    }

    public function shouldBePaid(): bool
    {
        return true;
    }
}

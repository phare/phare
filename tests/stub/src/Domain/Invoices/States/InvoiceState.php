<?php

namespace Stub\Domain\Invoices\States;

use Spatie\ModelStates\State;

abstract class InvoiceState extends State
{
    abstract public function getColour(): string;

    abstract public function shouldBePaid(): bool;
}

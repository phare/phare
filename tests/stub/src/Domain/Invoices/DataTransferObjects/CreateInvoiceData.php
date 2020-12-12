<?php

namespace Stub\Domain\Invoices\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class CreateInvoiceData extends DataTransferObject
{
    /** @var \Stub\Domain\Invoices\DataTransferObjects\InvoiceLineData[] */
    public array $invoiceLines = [];

    public ?string $number = null;

    public ?int $totalPrice = null;

    public function withNumber(string $number): self
    {
        $clone = clone $this;

        $clone->number = $number;

        return $clone;
    }

    public function withTotalPrice(int $totalPrice): self
    {
        $clone = clone $this;

        $clone->totalPrice = $totalPrice;

        return $clone;
    }
}

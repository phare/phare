<?php

namespace Tests\Factories;

use Domain\Invoices\Models\InvoiceLine;
use Support\TestFactories\Factory;

class InvoiceLineFactory extends Factory
{
    private string $description = 'Test line';

    private int $itemAmount = 1;

    private int $itemPrice = 1_00;

    private int $vatPercentage = 0;

    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): InvoiceLine
    {
        $invoice = InvoiceFactory::new()->create();

        return InvoiceLine::create(
            $extra + [
                'invoice_id' => $invoice->id,
                'description' => $this->description,
                'item_amount' => $this->itemAmount,
                'item_price' => $this->itemPrice,
                'vat_percentage' => $this->vatPercentage,
                'total_price_excluding_vat' => $this->itemPrice * $this->itemAmount,
                'total_price_including_vat' => $this->itemPrice * $this->itemAmount,
            ]
        );
    }

    public function withItemPrice(int $itemPrice): self
    {
        $clone = clone $this;

        $clone->itemPrice = $itemPrice;

        return $clone;
    }

    public function withItemAmount(int $itemAmount): self
    {
        $clone = clone $this;

        $clone->itemAmount = $itemAmount;

        return $clone;
    }

    public function withDescription(string $description): self
    {
        $clone = clone $this;

        $clone->description = $description;

        return $clone;
    }
}

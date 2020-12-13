<?php

namespace Tests\Factories;

use Domain\Invoices\DataTransferObjects\InvoiceLineData;
use Support\TestFactories\Factory;

class InvoiceLineDataFactory extends Factory

{
    private string $description = 'Test line';

    private int $itemAmount = 1;

    private int $itemPrice = 1_00;

    private int $vatPercentage = 0;

    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): InvoiceLineData
    {
        return new InvoiceLineData(
            $extra + [
                'description' => $this->description,
                'itemAmount' => $this->itemAmount,
                'itemPrice' => $this->itemPrice,
                'vatPercentage' => $this->vatPercentage,
                'totalPriceExcludingVat' => $this->itemPrice * $this->itemAmount,
                'totalPriceIncludingVat' => $this->itemPrice * $this->itemAmount,
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

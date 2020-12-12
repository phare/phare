<?php

namespace Tests\Factories;

use Domain\Invoices\Models\Invoice;
use Support\TestFactories\Factory;

class InvoiceFactory extends Factory
{
    private string $number = '001';

    private int $totalPrice = 100_00;

    private ?ClientFactory $clientFactory = null;

    public static function new(): InvoiceFactory
    {
        return new self();
    }

    public function create(array $extra = []): Invoice
    {
        return Invoice::create(
            $extra + [
                'number' => $this->number,
                'total_price' => $this->totalPrice,
                'client_id' => ($this->clientFactory ?? ClientFactory::new())->create()->id
            ]
        );
    }

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

    public function withClientFactory(ClientFactory $clientFactory): self
    {
        $clone = clone $this;

        $clone->clientFactory = $clientFactory;

        return $clone;
    }
}

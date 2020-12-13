<?php

namespace Tests\Factories;

use Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Support\TestFactories\Factory;

class CreateInvoiceDataFactory extends Factory
{
    private array $invoiceLineDataFactories = [];

    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): CreateInvoiceData
    {
        return new CreateInvoiceData(
            $extra + [
                'invoiceLines' => array_map(
                    fn(InvoiceLineDataFactory $factory) => $factory->create(),
                    $this->invoiceLineDataFactories
                ),
            ]
        );
    }

    public function addInvoiceLineDataFactory(InvoiceLineDataFactory $invoiceLineDataFactory): self
    {
        $clone = clone $this;

        $clone->invoiceLineDataFactories[] = $invoiceLineDataFactory;

        return $clone;
    }
}

<?php

namespace Tests\Invoices\Actions;

use Domain\Clients\Models\Client;
use Domain\Invoices\Actions\DetermineInvoiceNumberAction;
use Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Domain\Invoices\Models\Invoice;
use Tests\Factories\ClientFactory;
use Tests\Factories\InvoiceFactory;
use Tests\TestCase;

class DetermineInvoiceNumberActionTest extends TestCase
{
    private DetermineInvoiceNumberAction $action;

    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = app(DetermineInvoiceNumberAction::class);

        $this->client = ClientFactory::new()->create();
    }

    /** @test */
    public function __invoke()
    {
        InvoiceFactory::new()->withNumber('003')->create();
        InvoiceFactory::new()->withNumber('005')->create();

        /** @var \Domain\Invoices\Models\Invoice $invoice */
        $invoice = factory(Invoice::class)->state('paid')->create();

        $data = ($this->action)($this->client, new CreateInvoiceData());

        $this->assertEquals('006', $data->number);
    }
}

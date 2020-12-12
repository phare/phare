<?php

namespace Tests\Invoices\Actions;

use Domain\Clients\Models\Client;
use Domain\Invoices\Actions\CalculateInvoicePricesAction;
use Domain\Invoices\Actions\CreateInvoiceAction;
use Domain\Invoices\Actions\DetermineInvoiceNumberAction;
use Domain\Invoices\Actions\SaveInvoiceAction;
use Domain\Invoices\Models\Invoice;
use Domain\Payments\Actions\CreatePaymentAction;
use Tests\Factories\ClientFactory;
use Tests\Factories\CreateInvoiceDataFactory;
use Tests\Factories\InvoiceLineDataFactory;
use Tests\Mocks\MockCreatePdfAction;
use Tests\Mocks\MockSendInvoiceMailAction;
use Tests\TestCase;

class CreateInvoiceActionTest extends TestCase
{
    private Client $client;

    private CreateInvoiceAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = ClientFactory::new()->create();

        $this->action = app(CreateInvoiceAction::class);
    }

    /** @test */
    public function invoice_is_saved_in_the_database()
    {
        $createInvoiceData = CreateInvoiceDataFactory::new()
            ->addInvoiceLineDataFactory(
                InvoiceLineDataFactory::new()
                    ->withDescription('Line A')
                    ->withItemAmount(1)
                    ->withItemPrice(10_00)
            )
            ->addInvoiceLineDataFactory(
                InvoiceLineDataFactory::new()
                    ->withDescription('Line B')
                    ->withItemAmount(3)
                    ->withItemPrice(33_00)
            )
            ->create();

        $invoice = ($this->action)($this->client, $createInvoiceData);

        $expectedTotalPrice = 1 * 10_00 + 3 * 33_00;

        $this->assertInstanceOf(Invoice::class, $invoice);

        $this->assertDatabaseHas($invoice->getTable(), [
            'id' => $invoice->id,
            'total_price' => $expectedTotalPrice,
        ]);

        $this->assertNotNull($invoice->number);

        $this->assertEquals(
            $expectedTotalPrice,
            $invoice->total_price
        );
    }

    /** @test */
    public function invoice_mails_are_sent()
    {
        $sendInvoiceMailAction = new MockSendInvoiceMailAction();

        $action = new CreateInvoiceAction(
            new CalculateInvoicePricesAction(),
            new DetermineInvoiceNumberAction(),
            new SaveInvoiceAction(),
            new CreatePaymentAction(),
            new MockCreatePdfAction(),
            $sendInvoiceMailAction
        );

        $createInvoiceData = CreateInvoiceDataFactory::new()->create();

        $invoice = $action($this->client, $createInvoiceData);

        $this->assertTrue($sendInvoiceMailAction->invoiceWasSent($invoice));
    }
}

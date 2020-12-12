<?php

namespace Tests\Invoices\Subscribers;

use Domain\Invoices\Events\InvoiceSavingEvent;
use Domain\Invoices\Subscribers\InvoiceSubscriber;
use Tests\Factories\InvoiceFactory;
use Tests\TestCase;

class InvoiceSubscriberTest extends TestCase
{
    private InvoiceSubscriber $subscriber;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subscriber = app(InvoiceSubscriber::class);
    }

    /** @test */
    public function test_saving()
    {
        $event = new InvoiceSavingEvent(InvoiceFactory::new()->create());

        $this->subscriber->saving($event);

        $invoice = $event->invoice;

        $this->assertNotNull($invoice->total_price);
    }
}

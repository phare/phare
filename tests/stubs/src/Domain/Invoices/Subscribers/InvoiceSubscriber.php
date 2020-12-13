<?php

namespace Stub\Domain\Invoices\Subscribers;

use Stub\Domain\Invoices\Actions\CalculateInvoiceTotalPriceAction;
use Stub\Domain\Invoices\Events\InvoiceSavingEvent;
use Illuminate\Events\Dispatcher;

class InvoiceSubscriber
{
    private CalculateInvoiceTotalPriceAction $calculatePriceAction;

    public function __construct(CalculateInvoiceTotalPriceAction $calculatePriceAction)
    {
        $this->calculatePriceAction = $calculatePriceAction;
    }

    public function saving(InvoiceSavingEvent $event): void
    {
        $invoice = $event->invoice;

        $invoice->total_price = ($this->calculatePriceAction)($invoice);
    }

    public function subscribe(Dispatcher $dispatcher): void
    {
        $dispatcher->listen(
            InvoiceSavingEvent::class,
            self::class . '@saving'
        );
    }
}

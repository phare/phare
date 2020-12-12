<?php

namespace Tests\Mocks;

use Domain\Invoices\Actions\SendInvoiceMailAction;
use Domain\Invoices\Models\Invoice;
use Domain\Payments\Models\Payment;
use Domain\Pdfs\DataTransferObjects\Pdf;

class MockSendInvoiceMailAction extends SendInvoiceMailAction
{
    public array $sentInvoices = [];

    public function __invoke(Invoice $invoice, Pdf $pdf, Payment $payment): void
    {
        $this->sentInvoices[$invoice->id] = $invoice;
    }

    public function invoiceWasSent(Invoice $invoice): bool
    {
        return isset($this->sentInvoices[$invoice->id]);
    }
}

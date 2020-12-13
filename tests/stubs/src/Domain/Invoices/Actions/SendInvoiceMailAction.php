<?php

namespace Stub\Domain\Invoices\Actions;

use Stub\Domain\Invoices\Models\Invoice;
use Stub\Domain\Payments\Models\Payment;
use Stub\Domain\Pdfs\DataTransferObjects\Pdf;

class SendInvoiceMailAction
{
    public function __invoke(
        Invoice $invoice,
        Pdf $pdf,
        Payment $payment
    ): void {

    }
}

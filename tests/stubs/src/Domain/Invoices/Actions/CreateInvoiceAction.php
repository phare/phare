<?php

namespace Stub\Domain\Invoices\Actions;

use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Stub\Domain\Invoices\Models\Invoice;
use Stub\Domain\Payments\Actions\CreatePaymentAction;
use Stub\Domain\Pdfs\Actions\CreatePdfAction;

class CreateInvoiceAction
{
    private CalculateInvoicePricesAction $calculateInvoicePricesAction;

    private DetermineInvoiceNumberAction $determineInvoiceNumberAction;

    private SaveInvoiceAction $saveInvoiceAction;

    private CreatePaymentAction $createPaymentAction;

    private CreatePdfAction $createPdfAction;

    private SendInvoiceMailAction $sendInvoiceMailAction;

    public function __construct(
        CalculateInvoicePricesAction $calculateInvoicePricesAction,
        DetermineInvoiceNumberAction $determineInvoiceNumberAction,
        SaveInvoiceAction $saveInvoiceAction,
        CreatePaymentAction $createPaymentAction,
        CreatePdfAction $createPdfAction,
        SendInvoiceMailAction $sendInvoiceMailAction
    ) {
        $this->calculateInvoicePricesAction = $calculateInvoicePricesAction;
        $this->determineInvoiceNumberAction = $determineInvoiceNumberAction;
        $this->saveInvoiceAction = $saveInvoiceAction;
        $this->createPaymentAction = $createPaymentAction;
        $this->createPdfAction = $createPdfAction;
        $this->sendInvoiceMailAction = $sendInvoiceMailAction;
    }

    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ): Invoice {
        $data = ($this->calculateInvoicePricesAction)($client, $data);

        $data = ($this->determineInvoiceNumberAction)($client, $data);

        $invoice = ($this->saveInvoiceAction)($client, $data);

        $payment = ($this->createPaymentAction)($invoice);

        $pdf = ($this->createPdfAction)($invoice);

        ($this->sendInvoiceMailAction)($invoice, $pdf, $payment);

        return $invoice;
    }
}

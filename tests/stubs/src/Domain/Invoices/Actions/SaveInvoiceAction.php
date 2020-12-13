<?php

namespace Stub\Domain\Invoices\Actions;

use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Stub\Domain\Invoices\Models\Invoice;
use Stub\Domain\Invoices\Models\InvoiceLine;

class SaveInvoiceAction
{
    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ): Invoice {
        $invoice = Invoice::create([
            'client_id' => $client->id,
            'number' => $data->number,
            'total_price' => $data->totalPrice,
        ]);

        foreach ($data->invoiceLines as $invoiceLineData) {
            InvoiceLine::create([
                'invoice_id' => $invoice->id,
                'description' => $invoiceLineData->description,
                'item_amount' => $invoiceLineData->itemAmount,
                'item_price' => $invoiceLineData->itemPrice,
                'vat_percentage' => $invoiceLineData->vatPercentage,
                'total_price_excluding_vat' => $invoiceLineData->totalPriceExcludingVat,
                'total_price_including_vat' => $invoiceLineData->totalPriceIncludingVat,
            ]);
        }

        return $invoice->refresh();
    }
}

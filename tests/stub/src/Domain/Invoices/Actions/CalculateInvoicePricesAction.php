<?php

namespace Stub\Domain\Invoices\Actions;

use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Stub\Domain\Invoices\DataTransferObjects\InvoiceLineData;

class CalculateInvoicePricesAction
{
    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ): CreateInvoiceData {
        $totalPrice = array_reduce(
            $data->invoiceLines,
            fn(int $sum, InvoiceLineData $invoiceLineData) => $sum + $invoiceLineData->totalPriceIncludingVat,
            0
        );

        return $data->withTotalPrice($totalPrice);
    }
}

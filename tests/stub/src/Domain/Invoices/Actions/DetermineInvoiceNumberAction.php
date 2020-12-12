<?php

namespace Stub\Domain\Invoices\Actions;

use Stub\Domain\Clients\Models\Client;
use Stub\Domain\Invoices\DataTransferObjects\CreateInvoiceData;
use Stub\Domain\Invoices\Models\Invoice;

class DetermineInvoiceNumberAction
{
    public function __invoke(
        Client $client,
        CreateInvoiceData $data
    ): CreateInvoiceData {
        $latestInvoiceNumber = Invoice::query()->latestNumber();

        return $data->withNumber(
            str_pad(
                ((int) $latestInvoiceNumber) + 1,
                3,
                '0',
                STR_PAD_LEFT
            )
        );
    }
}

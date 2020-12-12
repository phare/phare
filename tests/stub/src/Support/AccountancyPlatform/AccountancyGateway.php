<?php

namespace Stub\Support\AccountancyPlatform;

use Stub\Support\AccountancyPlatform\DataTransferObjects\PendingInvoiceEntry;
use Stub\Support\AccountancyPlatform\DataTransferObjects\CreatedInvoiceEntry;

class AccountancyGateway
{
    private AccountancyClient $client;

    public function __construct(AccountancyClient $client)
    {
        $this->client = $client;
    }

    public function storeInvoice(PendingInvoiceEntry $invoiceEntry): CreatedInvoiceEntry
    {
        $response = $this->client->post('invoices', $invoiceEntry->toArray());

        return new CreatedInvoiceEntry($response['reference_id']);
    }
}

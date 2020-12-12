<?php

namespace Stub\App\Console\Commands;

use Stub\Domain\Invoices\Models\Invoice;
use Illuminate\Console\Command;
use Stub\Support\AccountancyPlatform\AccountancyGateway;
use Stub\Support\AccountancyPlatform\DataTransferObjects\PendingInvoiceEntry;

class SendInvoicesToAccountancyPlatformCommand extends Command
{
    protected $signature = 'accountancy:send-invoices';

    public function handle(AccountancyGateway $gateway)
    {
        $invoices = Invoice::whereNull('accountancy_reference_id')->get();

        foreach ($invoices as $invoice) {
            $pendingInvoiceEntry = PendingInvoiceEntry::fromInvoice($invoice);

            $createdInvoiceEntry = $gateway->storeInvoice($pendingInvoiceEntry);

            $invoice->fill([
                'accountancy_reference_id' => $createdInvoiceEntry->referenceId
            ])->save();
        }
    }
}

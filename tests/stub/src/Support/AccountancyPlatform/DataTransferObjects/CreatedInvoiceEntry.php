<?php

namespace Stub\Support\AccountancyPlatform\DataTransferObjects;

class CreatedInvoiceEntry
{
    public string $referenceId;

    public function __construct(string $referenceId)
    {
        $this->referenceId = $referenceId;
    }
}

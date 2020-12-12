<?php

namespace Stub\Domain\Payments;

use Stub\Domain\Clients\Models\Client;

interface Payable
{
    public function getTotalPrice(): int;

    public function getDescription(): string;

    public function getClient(): Client;
}

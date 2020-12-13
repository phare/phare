<?php

namespace Stub\Domain\Payments\Actions;

use Stub\Domain\Payments\Models\Payment;
use Stub\Domain\Payments\Payable;

class CreatePaymentAction
{
    public function __invoke(Payable $payable): Payment
    {
        return new Payment();
    }
}

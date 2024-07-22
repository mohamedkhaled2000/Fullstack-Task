<?php

namespace App\Traits;

use App\Facades\Payment;

trait Transactionable
{
    public function makeTransaction($amount)
    {
        $this->transactions()->create([
            'amount'            => $amount,
            'transaction_date'  => now()
        ]);

        return $this->makeInvoice($amount);
    }

    public function makeInvoice($amount)
    {
        return Payment::paymob()
            ->createInvoice([
                'amount' => $amount,
                'items' => [
                    [
                        'name' => 'Invoice',
                        'amount_cents' => $amount,
                        'description' => 'Invoice payment'
                    ]
                ]
            ], $this)->pay();
    }
}

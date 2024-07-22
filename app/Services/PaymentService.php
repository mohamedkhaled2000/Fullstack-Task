<?php

namespace App\Services;

use App\Repositries\PaymobPayment;

class PaymentService {
    private $payment;

    public function __construct() {
        if (config('payment.default') == 'paymob') {
            $this->payment = new PaymobPayment();
        }
    }

    public function paymob() {
        $this->payment = new PaymobPayment();
        return $this;
    }

    // Here you can add more payment methods like stripe, paypal, etc.

    public function createInvoice(array $items, $customer) {
        $this->checkSelectedPayment();
        ($this->payment)->createOrder($items)
            ->createPayment($customer)
            ->pay();

        return $this;
    }

    public function pay() {
        $this->checkSelectedPayment();
        return $this->payment->pay();
    }

    private function checkSelectedPayment(){
        throw_if(!(bool)$this->payment, new \Exception('Please select a payment type first!'));
    }
}

<?php

namespace App\Facades;

use App\Services\PaymentService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static function stripe()
 * @method static function paymob()
 * @method static function createInvoice(array $items, $customer)
 * @method static function pay()
 */

class Payment extends Facade {
    public static function getFacadeAccessor() {
        return 'payment';
    }
}

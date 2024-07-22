<?php

namespace App\Enums;

enum PaymentMethodEnum: string {
    case CREDIT_CARD = 'credit_card';
    case CASH = 'cash';
    case PAYMOB = 'paymob';

    public static function CREDIT_CARD()
    {
        return self::CREDIT_CARD->name;
    }

    public static function CASH()
    {
        return self::CASH->name;
    }

    public static function PAYMOB()
    {
        return self::PAYMOB->name;
    }
}

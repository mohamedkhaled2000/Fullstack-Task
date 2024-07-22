<?php

namespace App\Enums;

enum PaymentStatusEnum: string {
    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';

    public static function PENDING()
    {
        return self::PENDING->name;
    }

    public static function PAID()
    {
        return self::PAID->name;
    }

    public static function FAILED()
    {
        return self::FAILED->name;
    }
}

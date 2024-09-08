<?php
namespace App\Constants;

class PaymentMethods
{
    public const CREDIT_CARD = 'credit_card';
    public const PAYPAL = 'paypal';
    public const CASH_ON_DELIVERY = 'cash_on_delivery';

    public static function getAllMethods()
    {
        return [
            self::CREDIT_CARD,
            self::PAYPAL,
            self::CASH_ON_DELIVERY,
        ];
    }
}

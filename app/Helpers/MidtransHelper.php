<?php

namespace App\Helpers;

use Midtrans\Snap;
use Midtrans\Config;

class MidtransHelper
{
    public static function init()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION') === 'true';
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public static function createTransaction($order)
    {
        self::init();

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->amount, // contoh: 150000
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ]
        ];

        return Snap::createTransaction($params);
    }
}

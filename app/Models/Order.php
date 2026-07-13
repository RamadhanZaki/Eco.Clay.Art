<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id', 'customer_name', 'phone', 'product_name',
        'quantity', 'custom_description', 'status'
    ];

    public static function generateOrderId()
    {
        $lastOrder = self::orderBy('id', 'desc')->first();
        $number = $lastOrder ? intval(substr($lastOrder->order_id, 3)) + 1 : 1;
        return 'ECO' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}

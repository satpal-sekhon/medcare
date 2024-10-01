<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(OrderPrescription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = self::generateOrderNumber();
            }
        });
    }

    /**
     * Generate the next order number.
     *
     * @return string
     */
    protected static function generateOrderNumber()
    {
        // Define prefix
        $prefix = 'ORD-';

        // Get the last order number
        $lastOrder = self::where('order_number', 'like', $prefix . '%')
            ->orderBy('order_number', 'desc')
            ->first();

        // Generate the next number
        $nextNumber = 1;

        if ($lastOrder) {
            $lastNumber = (int) substr($lastOrder->order_number, strlen($prefix));
            $nextNumber = $lastNumber + 1;
        }

        // Format number with leading zeros
        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Constants\PaymentMethods;

class LabPackageOrder extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function setPaymentMethodAttribute($value)
    {
        if (!in_array($value, PaymentMethods::getAllMethods())) {
            throw new \InvalidArgumentException('Invalid payment method');
        }
        $this->attributes['payment_method'] = $value;
    }

    public function labPackage()
    {
        return $this->belongsTo(LabPackage::class);
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
        $prefix = 'QKODR-';

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

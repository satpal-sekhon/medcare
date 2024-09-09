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
}

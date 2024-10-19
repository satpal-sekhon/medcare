<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function products()
    {
        return $this->hasMany(BillProduct::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'billed_by');
    }
}

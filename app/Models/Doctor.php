<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function doctorType()
    {
        return $this->belongsTo(DoctorType::class, 'doctor_type_id', 'id');
    }
}

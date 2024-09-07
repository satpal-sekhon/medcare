<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPackage extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function labTests()
    {
        return $this->belongsToMany(LabTest::class, 'lab_package_tests', 'lab_package_id', 'lab_test_id');
    }
}

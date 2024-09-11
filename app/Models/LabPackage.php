<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class LabPackage extends Model
{
    use HasFactory, Sluggable;
    protected $guarded=[];

    public function labTests()
    {
        return $this->belongsToMany(LabTest::class, 'lab_package_tests', 'lab_package_id', 'lab_test_id');
    }

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true, // Regenerate slug on name change
                'unique' => true, // Ensure uniqueness
            ]
        ];
    }
}

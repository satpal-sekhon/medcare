<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function diseases()
    {
        return $this->hasMany(ProductDisease::class);
    }

    public function diseaseIds()
    {
        return $this->diseases->pluck('disease_id')->toArray();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

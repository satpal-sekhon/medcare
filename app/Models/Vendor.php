<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Vendor extends Model
{
    use HasFactory, Sluggable;
    protected $guarded=[];

    public function assets()
    {
        return $this->hasMany(VendorAsset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->vendor_code)) {
                $user->vendor_code = self::generateUserCode();
            }
        });
    }

    /**
     * Generate the next vendor code.
     *
     * @return string
     */
    protected static function generateUserCode()
    {
        // Define prefix
        $prefix = 'VNDR-';

        // Get the last vendor number
        $lastVendor = self::where('vendor_code', 'like', $prefix . '%')
            ->orderBy('vendor_code', 'desc')
            ->first();

        // Generate the vendor number
        $nextNumber = 1;

        if ($lastVendor) {
            $lastNumber = (int) substr($lastVendor->vendor_code, strlen($prefix));
            $nextNumber = $lastNumber + 1;
        }

        // Format number with leading zeros
        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}

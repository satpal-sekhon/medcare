<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'city',
        'pincode',
        'state',
        'profile_pic',
        'password',
        'status',
        'otp',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vendor(){
        return $this->hasOne(Vendor::class);
    }

    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->user_code)) {
                $user->user_code = self::generateUserCode();
            }
        });
    }

    /**
     * Generate the next user code.
     *
     * @return string
     */
    protected static function generateUserCode()
    {
        // Define prefix
        $prefix = 'USR-';

        // Get the last user code
        $lastUser = self::where('user_code', 'like', $prefix . '%')
            ->orderBy('user_code', 'desc')
            ->first();

        // Generate the next number
        $nextNumber = 1;

        if ($lastUser) {
            $lastNumber = (int) substr($lastUser->user_code, strlen($prefix));
            $nextNumber = $lastNumber + 1;
        }

        // Format number with leading zeros
        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }


    /**
     * Generate an OTP, send an email for verification, and return the OTP.
     *
     * @param string $name
     * @param string $email
     * @return int
     */
    public function sendOtp($name, $email)
    {
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Prepare the data to send
        $data = [
            'otp'   => $otp,
            'name'  => $name,
            'email' => $email
        ];

        // Try sending the OTP email
        //try {
            Mail::to($email)->send(new VerifyEmail($data));
        /* } catch (\Exception $e) {
            throw new \Exception('Invalid email or failed to send email. Please try again.');
        } */

        return $otp;
    }
}

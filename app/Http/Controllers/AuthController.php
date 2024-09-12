<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use App\Models\State;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->hasRole('Customer')) {
                return redirect()->route('my-account');
            } else if($user->hasRole('Vendor')){
                return redirect()->route('vendor-dashboard');
            } else {
                return redirect()->route('admin-dashboard');
            }
        }

        return view('login');
    }

    public function create_account(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name'         => 'required|string|max:50',
            'email'        => 'required|email|max:100|unique:users,email',
            'phone_number' => 'required|digits:10',
            'password'     => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:password',
            'terms'        => 'required|in:accepted',
        ]);

        try {
            $user = new User();
            $otp = $user->sendOtp($request->name, $request->email);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }

        // Save the user
        $user = User::create([
            'name'          => $request->input('name'),
            'email'         => $request->input('email'),
            'phone_number'  => preg_replace('/\D/', '', $request->input('phone_number')),
            'password'      => Hash::make($request->input('password')),
            'otp'           => $otp
        ]);
        // Assign role to user
        $user->assignRole('Customer');


        $request->session()->put('reset_email', $request->email);

        return redirect()->route('verify-email')->with('success', 'Account created successfully! Please check your email to verify your account.');
    }

    public function vendor_registration()
    {
        $states = State::select('name')->get();
        return view('register-vendor', compact('states'));
    }

    /**
     * Handle file uploads and return the file path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    private function uploadFile($file, $directory)
    {
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($directory), $filename);
        return $directory . $filename;
    }

    public function create_vendor_account(Request $request)
    {
        $request->validate([
            'full_name'             => 'required|string|max:50',
            'email'                 => 'required|email|max:100|unique:users,email',
            'phone_number'          => 'required|digits:10|unique:users,phone_number',
            'address'               => 'required|string|max:255',
            'city'                  => 'required|string|max:50',
            'pincode'               => 'required|digits:6',
            'state'                 => 'required|string|max:50',
            'new_password'          => 'required|string|max:25',
            'confirm_password'      => 'required|string|max:25|same:new_password',
            'terms'                 => 'required|in:accepted',

            'business_name'         => 'required|string|max:75',
            'business_email'        => 'required|email|max:100|unique:vendors,email',
            'business_phone_number' => 'required|digits:10|unique:vendors,phone_number',
            'business_address'      => 'required|string|max:255',
            'business_city'         => 'required|string|max:50',
            'business_pincode'      => 'required|digits:6',
            'business_state'        => 'required|string|max:50',
            'license_number'        => 'required|string',
        ]);


        try {
            $user = new User();
            $otp = $user->sendOtp($request->full_name, $request->email);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }

        // Save the user
        $user = User::create([
            'name'          => $request->input('full_name'),
            'email'         => $request->input('email'),
            'phone_number'  => preg_replace('/\D/', '', $request->input('phone_number')),
            'address'       => $request->input('address'),
            'city'          => $request->input('city'),
            'pincode'       => $request->input('pincode'),
            'state'         => $request->input('state'),
            'password'      => Hash::make($request->input('new_password')),
            'otp'           => $otp
        ]);
        // Assign role to user
        $user->assignRole('Vendor');

        $request->session()->put('reset_email', $request->email);

        $user->vendor()->create([
            'name'              => $request->input('business_name'),
            'email'             => $request->input('business_email'),
            'phone_number'      => preg_replace('/\D/', '', $request->input('business_phone_number')),
            'address'           => $request->input('business_address'),
            'city'              => $request->input('business_city'),
            'state'             => $request->input('business_state'),
            'pincode'           => $request->input('business_pincode'),
            'type'              => $request->input('business_type'),
            'shop_type'         => $request->input('shop_type'),
            'license_number'    => $request->input('license_number'),
        ]);

        return redirect()->route('verify-email')->with('success', 'Please check your email to verify your account. So that we can verify your account.');
    }


    public function resend_verification_email()
    {
        try {
            $email = session('reset_email');

            if (!$email) {
                return back()->withInput()->withErrors([
                    'message' => 'No email address found in session.',
                ]);
            }

            $user = User::where('email', $email)->first();

            if (!$user) {
                // Handle the case where no user is found with the email
                return back()->withInput()->withErrors([
                    'message' => 'User with the specified email does not exist.',
                ]);
            }

            $otp = $user->sendOtp($user->name, $email);
            $user->otp = $otp;
            $user->save();

            return redirect()->route('verify-email')->with('success', 'OTP sent successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function admin_login()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('Customer')) {
                return redirect()->route('my-account');
            } else {
                return redirect()->route('admin-dashboard');
            }
        }

        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        $user = User::where('email', $credentials['email'])->first();

        // Check if user exists and email is verified
        if (!$user) {
            return back()->withInput()->withErrors([
                'message' => 'Invalid login credentials',
            ]);
        } else if (!Hash::check($request->input('password'), $user->password)) {
            return back()->withInput()->withErrors([
                'message' => 'Invalid login credentials',
            ]);
        } else if (!$user->email_verified_at && !$user->hasRole('Admin')) {
            // Store email in session in the case if user wants to verify email
            $request->session()->put('reset_email', $request->email);

            return back()->withInput()->withErrors([
                'message' => 'Email is not verified. <a href="' . route('resend-verification-email') . '">Click here to verify</a>',
            ]);
        } else {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if ($user->hasRole('Customer')) {
                    return redirect()->route('my-account');
                } else {
                    return redirect()->route('admin-dashboard');
                }
            }
        }

        return back()->withErrors([
            'message' => 'Invalid login credentials',
        ]);
    }

    public function admin_logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function signup()
    {
        return view('signup');
    }

    public function forgot_password()
    {
        return view('forgot-password');
    }

    public function send_reset_password_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate a password reset token
            $token = Str::random(60);

            // Store the token in the password_resets table
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                ['token' => Hash::make($token), 'created_at' => now()]
            );

            $data = [
                'token' => $token,
                'email' => $request->email
            ];

            try {
                // Attempt to send the password reset email
                Mail::to($request->email)->send(new ResetPasswordMail($data));

                // Store email in session
                $request->session()->put('reset_email', $request->email);

                return redirect()->route('forgot-password')->with('success', 'Password reset link sent to your email.');
            } catch (\Exception $e) {
                // Redirect back with an error message
                return redirect()->route('forgot-password')->with('error', 'Failed to send email. Please try again later.');
            }
        } else {
            return redirect()->route('forgot-password')->with('error', 'User not found');
        }
    }


    public function verify_email()
    {
        $email = session('reset_email');
        return view('verify-email', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp'   => 'required',
            'email' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && $user->otp == $request->otp) {
            $user->update([
                'otp' => null,
                'email_verified_at' => $user->email_verified_at ?? now()
            ]);

            return redirect()->route('login')->with('success', 'Email verified successfully!');
            $request->session()->forget('reset_email');
        } else {
            return redirect()->back()->with('error', 'Incorrect OTP');
        }
    }

    public function reset_password()
    {
        $email = session('reset_email');

        return view('change-password', compact('email'));
    }

    public function password(Request $request)
    {
        $request->validate([
            'email'             => 'required|email',
            'new_password'      => 'required',
            'confirm_password'  => 'required|same:new_password'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            $request->session()->forget('reset_email');

            return redirect()->route('login')->with('success', 'Password changed successfully');
        } else {
            return redirect()->route('change-password')->with('error', 'No user found with this email address');
        }
    }
}

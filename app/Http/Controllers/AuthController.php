<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\VerifyOtp;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->hasRole('Customer')) {
                return redirect()->route('my-account');
            } else {
                return redirect()->route('admin-dashboard');
            }
        }

        return view('login');
    }

    public function create_account(Request $request){
        // Validate the form data
        $request->validate([
            'name'         => 'required|string|max:50',
            'email'        => 'required|email|max:100|unique:users,email',
            'phone_number' => 'required|digits:10',
            'password'     => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:password',
            'terms'        => 'required|in:accepted',
        ]);

        $otp = rand(100000, 999999);
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

        // Send Otp to verify Account
        $data = [
            'otp'   => $otp,
            'name'  => $request->name,
            'email' => $request->email
        ];

        Mail::to($request->email)->send(new VerifyOtp($data));

        $request->session()->put('reset_email', $request->email);

        // Redirect or return a success response
        return redirect()->route('verify-email')->with('success', 'Please verify your email!');
    }

    public function admin_login(){
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
            return back()->withErrors([
                'message' => 'Invalid login credentials',
            ]);
        } else if(!Hash::check($request->input('password'), $user->password)){
            return back()->withErrors([
                'message' => 'Invalid login credentials',
            ]);
        } else if(!$user->email_verified_at && !$user->hasRole('Admin')){
            return back()->withErrors([
                'message' => 'Email is not verified',
            ]);
        } else{
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

    public function admin_logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    public function signup(){
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
            return redirect()->back()->with('error', 'This OTP is not valid please enter valid OTP.');
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

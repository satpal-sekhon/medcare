<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users,email',
            'phone_number' => 'required|digits:10',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:password',
            'terms' => 'required|in:accepted',
        ]);

        // Save the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => preg_replace('/\D/', '', $request->input('phone_number')),
            'password' => Hash::make($request->input('password')),
        ]);
        // Assign role to user
        $user->assignRole('Customer');

        // Redirect or return a success response
        return redirect()->route('login')->with('success', 'Account created successfully!');
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
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = auth()->user();

            if ($user->hasRole('Customer')) {
                return redirect()->route('my-account');
            } else {
                return redirect()->route('admin-dashboard');
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

    
    public function forgot_password(){
        return view('forgot-password');
    }

    public function verify_email(){
        return view('verify-email');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

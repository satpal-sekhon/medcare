<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function user_account(){
        return view('frontend.my-account.dashboard');
    }

    public function wishlist(){
        return view('frontend.my-account.wishlist');
    }

    public function orders(){
        return view('frontend.my-account.orders');
    }

    public function addresses(){
        return view('frontend.my-account.addresses');
    }

    public function profile(){
        return view('frontend.my-account.profile');
    }
}

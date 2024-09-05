<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('frontend.my-account.addresses', compact('addresses'));
    }

    public function profile(){
        return view('frontend.my-account.profile');
    }
}

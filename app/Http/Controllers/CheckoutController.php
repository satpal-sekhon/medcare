<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        $cart = session()->get('cart', []);
        if(empty($cart['total'])){
            return redirect()->route('cart');
        }

        $states = State::select('name', 'code')->orderBy('name', 'asc')->get();
        return view('frontend.checkout', compact('states'));
    }

    public function success(){
        return view('frontend.order-success');
    }
}

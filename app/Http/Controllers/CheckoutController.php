<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $placed_order_id = session()->get('order_id');
        if(!$placed_order_id){
            return redirect()->route('home');
        }

        $order = Order::with('items')->find($placed_order_id);

        if(!$order){
            return redirect()->route('home');
        }
        return view('frontend.order-success', compact('order'));
    }
}

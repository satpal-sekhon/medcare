<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create_order(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart['total'])) {
            return response()->json([
                'success' => false,
                'status' => 'EMPTY_CART',
                'message' => 'Your cart is empty!'
            ]);
        }

        $order = Order::create([
            'user_id' => $request->user()->id ?? null,
            'shipping_address' => json_encode($request->deliveryAddress),
            'shipping_method' => json_encode($request->selectedDeliveryMethod),
            'payment_method' => $request->selectedPaymentMethod,
            'sub_total' => $cart['sub_total'],
            'total' => $cart['total'],
            'coupon_code' => $cart['applied_coupon'],
        ]);

        $orderItems = $cart['products'];
        if ($orderItems) {
            foreach ($orderItems as $item) {
                $order->items()->create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'brand_name' => $item['brand'],
                    'primary_category_name' => $item['primary_category'],
                    'category_name' => $item['category'],
                    'product_type' => $item['product_type'] ?? 'General',
                    'thumbnail' => $item['image'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'mrp' => $item['mrp'] ?? 0,
                ]);
            }
        }

        session()->forget('cart');
        session()->put('order_id', $order->id);

        return response()->json([
            'success' => true,
            'order' => $order
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}

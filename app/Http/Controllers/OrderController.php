<?php

namespace App\Http\Controllers;

use App\Mail\ProductOrderUpdate;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index(){
        return view('admin.orders.index');
    }

    public function adminTransactions(){
        return view('admin.transactions.index');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'email', 'phone_number'];
    
        // Eager load the items relationship to calculate sum later
        $query = Order::with('user')
            ->withCount('items as total_quantity')
            ->select('orders.*');
    
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('shipping_address', 'like', "%{$search}%")
                  ->orWhere('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                    $q->where('user_code', 'like', "%{$search}%");
                  });;
            });
        }

        if($request->has('user_id')){
            $user_id = $request->user_id;
            $query->where(function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            });
        }
    
        $totalRecords = $query->count();
        $filteredRecords = $query->count(); // This is before applying pagination
    
        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }
    
        // Apply pagination
        $orders = $query->skip($request->start)->take($request->length)->get();
    
        // Calculate total quantities
        $orders->each(function ($order) {
            $order->total_quantity = $order->items->sum('quantity');
        });
    
        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $orders
        ]);
    }

    public function getTransactions(Request $request)
    {
        $columns = ['id', 'name', 'payment_method', 'transaction_id', 'payment_status', 'created_at'];
    
        // Eager load the items relationship to calculate sum later
        $query = Order::whereNotNull('transaction_id')->with('user')
            ->select('orders.*');
    
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('shipping_address', 'like', "%{$search}%")
                  ->orWhere('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                    $q->where('user_code', 'like', "%{$search}%");
                  });;
            });
        }

        if($request->has('user_id')){
            $user_id = $request->user_id;
            $query->where(function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            });
        }
    
        $totalRecords = $query->count();
        $filteredRecords = $query->count(); // This is before applying pagination
    
        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }
    
        // Apply pagination
        $orders = $query->skip($request->start)->take($request->length)->get();
    
        // Calculate total quantities
        $orders->each(function ($order) {
            $order->total_quantity = $order->items->sum('quantity');
        });
    
        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $orders
        ]);
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
            'shipping_address' => $request->deliveryAddress,
            'shipping_method' => $request->selectedDeliveryMethod,
            'payment_method' => isset(json_decode($request->selectedPaymentMethod)->method) ? json_decode($request->selectedPaymentMethod)->method : json_decode($request->selectedPaymentMethod),
            'sub_total' => $cart['sub_total'],
            'total' => $cart['total'],
            'discount' => $cart['discount_amount'] ?? null,
            'coupon_code' => $cart['applied_coupon'] ?? '',
            'transaction_id' => $request->transactionId,
            'payment_status' => $request->transactionId ? 'Completed' : 'Pending',
            'status' => 'Awaiting Confirmation',
        ]);

        $orderItems = $cart['products'];
        if ($orderItems) {
            foreach ($orderItems as $productId => $item) {
                if(isset($item['product_id'])){
                    $order->items()->create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'name' => $item['name'],
                        'unit' => $item['unit'],
                        'brand_name' => $item['brand'],
                        'primary_category_name' => $item['primary_category'],
                        'category_name' => $item['category'],
                        'product_type' => $item['product_type'] ?? 'General',
                        'thumbnail' => $item['image'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'mrp' => $item['mrp'] ?? 0,
                    ]);
                } else{
                    foreach($item['variants'] as $variant){
                        $order->items()->create([
                            'order_id' => $order->id,
                            'product_id' => $variant['product_id'],
                            'variant_id' => $variant['variant_id'],
                            'name' => $variant['name'],
                            'unit' => $variant['unit'],
                            'brand_name' => $variant['brand'],
                            'primary_category_name' => $variant['primary_category'],
                            'category_name' => $variant['category'],
                            'product_type' => $variant['product_type'] ?? 'General',
                            'thumbnail' => $variant['image'],
                            'quantity' => $variant['quantity'],
                            'price' => $variant['price'],
                            'mrp' => $variant['mrp'] ?? 0,
                        ]);
                    }
                }
                
            }
        }

        if ($request->hasFile('prescriptions')) {
            foreach ($request->file('prescriptions') as $file) {
                $mimeType = $file->getMimeType();
                $path = uploadFile($file, 'uploads/orders/prescriptions/');

                $order->prescriptions()->create([
                    'path' => $path,
                    'mime_type' => $mimeType
                ]);
            }
        }

        if (Auth::check()) {
            $user = Auth::user();
            $cart = $user->cart;

            if ($cart) {
                $cart->delete();
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
        return view('admin.orders.edit-product-order', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->payment_status = $request->payment_status;
        $order->update = $request->order_update;
        $order->save();

        $shippingAddress = json_decode($order->shipping_address);

        $data = [
            'customer_name' => $shippingAddress->customerName,
            'order_number' => $order->order_number,
            'status' => $order->status,
            'payment_status' => $order->payment_status,
            'order_update' => $order->update,
            'email' => $shippingAddress->email
        ];

        Mail::to($shippingAddress->email)->send(new ProductOrderUpdate($data));

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully.'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.cart');
    }

    // Add or update item in the cart
    public function addOrUpdate(Request $request)
    {
        // Validate request input
        $validated = $request->validate([
            'productId' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $validated['productId'];
        $quantity = $validated['quantity'];

        // Retrieve product details from the database
        $product = Product::with('brand', 'category', 'primaryCategory')
            ->select('id', 'brand_id', 'category_id', 'primary_category_id', 'name', 'slug', 'customer_price', 'mrp', 'product_type', 'flag', 'thumbnail')
            ->find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found!'], 404);
        }

        // Retrieve the current cart from the session
        $cart = session()->get('cart', []);
        $cart_status = '';

        // Check if the item already exists in the cart
        if (isset($cart['products'][$productId])) {
            // Update the quantity
            $cart['products'][$productId]['quantity'] = $quantity;
            $cart_status = 'UPDATED';
        } else {
            // Add new item to the cart with detailed information
            $cart['products'][$productId] = [
                'quantity' => $quantity,
                'product_id' => $product->id,
                'primary_category_id' => $product->primary_category_id,
                'brand_id' => $product->brand_id,
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'product_type' => $product->product_type,
                'price' => $product->customer_price,
                'mrp' => $product->mrp,
                'flag' => $product->flag,
                'brand' => $product->brand->name,
                'primary_category' => $product->primaryCategory->name,
                'category' => $product->category->name,
                'image' => $product->thumbnail,
            ];
            $cart_status = 'ADDED';
        }

        // Calculate the new total
        $cart['sub_total'] = $this->calculateTotal($cart['products']);
        $cart['total'] = $this->calculateTotal($cart['products']);

        // Calculate the total number of items in the cart
        $cart['total_items'] = array_sum(array_column($cart['products'], 'quantity'));

        $cart['applied_coupon'] = $cart['applied_coupon'] ?? null;

        // Store the updated cart back in the session
        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::firstOrCreate(['user_id' => $userId]);
            $userCart->items = json_encode($cart);
            $userCart->save();
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'status' => $cart_status, 'cart' => $cart]);
    }

    private function calculateTotal($products)
    {
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        return $total;
    }


    public function getDetails()
    {
        $cart = session()->get('cart', []);

        if (Auth::check()) {
            $user = Auth::user();
            $cart = $user->cart;

            if ($cart->items ?? null) {
                $cart = json_decode($cart->items, true);
                session()->put('cart', $cart);
            }
        }

        return response()->json(['cart' => $cart]);
    }

    // Delete item from the cart
    public function delete($id)
    {
        // Retrieve the current cart from the session
        $cart = session()->get('cart', []);

        // Check if the item exists in the cart
        if (!isset($cart['products'][$id])) {
            return response()->json(['error' => 'Item not found in cart!'], 404);
        }

        // Remove the item from the cart
        unset($cart['products'][$id]);

        // Calculate the new total
        $cart['total'] = $this->calculateTotal($cart['products']);

        // Calculate the total number of items in the cart
        $cart['total_items'] = array_sum(array_column($cart['products'], 'quantity'));

        // Handle applied coupons if needed
        $cart['applied_coupon'] = $cart['applied_coupon'] ?? null;
        
        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::firstOrCreate(['user_id' => $userId]);
            $userCart->items = json_encode($cart);
            $userCart->save();
        }
        session()->put('cart', $cart);

        return response()->json(['success' => 'Item removed from cart!', 'cart' => $cart]);
    }

    public function applyCoupon(Request $request){
        $couponCode = $request->input('code');
        $coupon = Coupon::where('code', $couponCode)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('start_date')
                    ->orWhere('start_date', '<=', Carbon::now());
            })
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>=', Carbon::now());
            })
            ->first();
      
        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired coupon code.'
            ], 400);
        }
        
          
        $cart = session()->get('cart', []);
        
        if(!isset($cart['total'])){
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        $totalAmount = $cart['total'];
        $discount = 0;

        if ($coupon->discount_type == 'amount') {
            $discount = $coupon->discount_amount;
        } elseif ($coupon->discount_type == 'percentage') {
            $discount = ($coupon->discount_amount / 100) * $totalAmount;
        }

        // Apply discount
        $cart['applied_coupon'] = $couponCode;
        $cart['discount_amount'] = (float)$discount;
        $cart['total'] = (float)$cart['sub_total'] - (float)$discount;
        session()->put('cart', $cart);

        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::firstOrCreate(['user_id' => $userId]);
            $userCart->items = json_encode($cart);
            $userCart->save();
        }


        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'cart' => $cart
        ], 200);
    }
}

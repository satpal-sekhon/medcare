<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
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
            'variantId' => 'sometimes|integer|exists:product_variants,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $priceColumn = 'customer_price';
        if(isVendor()){
            $priceColumn = 'vendor_price';
        }

        $productId = $validated['productId'];
        $variantId = $validated['variantId'] ?? null; 
        $quantity = $validated['quantity'];

        // Retrieve product details from the database
        $product = Product::with('brand', 'category', 'primaryCategory', 'variants')
            ->select('id', 'brand_id', 'category_id', 'primary_category_id', 'name', 'unit', 'slug', 'customer_price', 'vendor_price', 'mrp', 'product_type', 'flag', 'thumbnail', 'is_prescription_required')
            ->find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found!'], 404);
        }

        // Retrieve the current cart from the session
        $cart = session()->get('cart', []);
        $cart_status = '';

        // Check if the item already exists in the cart
        if ($product->variants->isNotEmpty() && $variantId) {
            // Handle product with variants
            if (isset($cart['products'][$productId]['variants'][$variantId])) {
                // Update the quantity for the existing variant
                $cart['products'][$productId]['variants'][$variantId]['quantity'] = $quantity;
                $cart_status = 'UPDATED';
            } else {
                $variant = $product->variants->where('id', $variantId)->first();

                // Add new variant to the cart
                $cart['products'][$productId]['variants'][$variantId] = [
                    'quantity' => $quantity,
                    'product_id' => $product->id,
                    'variant_id' => $variantId,
                    'unit' => $variant->name,
                    'primary_category_id' => $product->primary_category_id,
                    'brand_id' => $product->brand_id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'product_type' => $product->product_type,
                    'price' => $variant->$priceColumn,
                    'mrp' => $variant->mrp,
                    'flag' => $product->flag,
                    'brand' => $product->brand->name,
                    'primary_category' => $product->primaryCategory->name,
                    'category' => $product->category->name,
                    'image' => $product->thumbnail,
                    'is_prescription_required' => $product->is_prescription_required,
                ];
                $cart_status = 'ADDED';
            }
        } else {
            // Handle product without variants
            if (isset($cart['products'][$productId]['quantity'])) {
                // Update the quantity for the existing product
                $cart['products'][$productId]['quantity'] = $quantity ?? 0;
                $cart_status = 'UPDATED';
            } else {
                if(isset($cart['products'][$productId]['variants'])){
                    $variants = $cart['products'][$productId]['variants'];
                }

                // Add new product to the cart
                $cart['products'][$productId] = [
                    'quantity' => $quantity,
                    'product_id' => $product->id,
                    'primary_category_id' => $product->primary_category_id,
                    'brand_id' => $product->brand_id,
                    'name' => $product->name,
                    'unit' => $product->unit,
                    'slug' => $product->slug,
                    'product_type' => $product->product_type,
                    'price' => $product->$priceColumn,
                    'mrp' => $product->mrp,
                    'flag' => $product->flag,
                    'brand' => $product->brand->name,
                    'primary_category' => $product->primaryCategory->name,
                    'category' => $product->category->name,
                    'image' => $product->thumbnail,
                    'is_prescription_required' => $product->is_prescription_required,
                ];
                $cart_status = 'ADDED';

                if(isset($variants)){
                    $cart['products'][$productId]['variants'] = $variants;
                }
            }
        }

        // Calculate the new total
        $cart['sub_total'] = $this->calculateTotal($cart['products']);
        $cart['total'] = $this->calculateTotal($cart['products']);

        // Calculate the total number of items in the cart
        $totalItems = 0;

        // Iterate through products to sum total quantities including variants
        foreach ($cart['products'] as $product) {
            // Add product quantity
            $totalItems += $product['quantity'] ?? 0;

            // If the product has variants, sum their quantities
            if (isset($product['variants'])) {
                foreach ($product['variants'] as $variant) {
                    $totalItems += $variant['quantity'];
                }
            }
        }

        // Set total_items
        $cart['total_items'] = $totalItems;


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
            $total += ($product['price'] ?? 0) * ($product['quantity'] ?? 0);

            if(isset($product['variants'])){
                foreach($product['variants'] as $variant){
                    $total += ($variant['price'] ?? 0) * ($variant['quantity'] ?? 0);
                }
            }

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
    public function delete(Request $request, $id)
    {
        // Retrieve the current cart from the session
        $cart = session()->get('cart', []);

        if(isset($request->variantId) && $request->variantId > 0){
            if (!isset($cart['products'][$id]['variants'][$request->variantId])) {
                return response()->json(['error' => 'Item not found in cart!'], 404);
            }
        }

        // Check if the item exists in the cart
        if (!isset($cart['products'][$id])) {
            return response()->json(['error' => 'Item not found in cart!'], 404);
        }

        // Remove the item from the cart
        if(isset($request->variantId) && $request->variantId > 0){
            unset($cart['products'][$id]['variants'][$request->variantId]);
        } else if(isset($cart['products'][$id]['variants'])){
            $variants = $cart['products'][$id]['variants'];
            unset($cart['products'][$id]);
            $cart['products'][$id]['variants'] = $variants;
        } else {
            unset($cart['products'][$id]);
        }

        // Calculate the new total
        $cart['total'] = $this->calculateTotal($cart['products']);

        // Calculate the total number of items in the cart
        $totalItems = 0;

        // Iterate through products to sum total quantities including variants
        foreach ($cart['products'] as $product) {
            // Add product quantity
            $totalItems += $product['quantity'] ?? 0;

            // If the product has variants, sum their quantities
            if (isset($product['variants'])) {
                foreach ($product['variants'] as $variant) {
                    $totalItems += $variant['quantity'];
                }
            }
        }

        // Set total_items
        $cart['total_items'] = $totalItems;


        // Handle applied coupons if needed
        $cart['applied_coupon'] = $cart['applied_coupon'] ?? null;
        
        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::firstOrCreate(['user_id' => $userId]);
            $userCart->items = json_encode($cart);
            $userCart->save();
        }

        
        if($totalItems === 0){
            $cart = [];
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

        if(!Auth::id()){
            return response()->json([
                'success' => false,
                'message' => 'You need to login to apply this coupon'
            ], 400);
        }

        $isAppliedCoupon = Order::where('user_id', Auth::id())->where('coupon_code', $couponCode)->first();
        if($isAppliedCoupon){
            return response()->json([
                'success' => false,
                'message' => 'You already used this coupon'
            ], 400);
        }
          
        $cart = session()->get('cart', []);
        
        if(!isset($cart['total'])){
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        $totalAmount = (float) $cart['total'];
        $discount = 0;
        
        $eligibleOrderAmount = (float) $coupon->minimum_amount;
        if($eligibleOrderAmount && ($eligibleOrderAmount > $totalAmount)){
            return response()->json([
                'success' => false,
                'message' => 'Minimum order amount should be ₹'.$eligibleOrderAmount.' to apply this coupon'
            ], 400);
        }

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

    public function removeAppliedCoupon(Request $request){
        $cart = session()->get('cart', []);

        $cart['applied_coupon'] = null;
        $discount_amount = 0;
        if(isset($cart['discount_amount'])){
            $discount_amount = (float)$cart['discount_amount'] ?? 0;
      
        }

        $cart['total'] = (float) $cart['total'] + $discount_amount;
        unset($discount_amount);
        
        session()->put('cart', $cart);

        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::firstOrCreate(['user_id' => $userId]);
            $userCart->items = json_encode($cart);
            $userCart->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Applied coupon removed successfully.',
            'cart' => $cart
        ], 200);
    }

    public function applyCharges(Request $request){
        $cart = session()->get('cart', []);

        $discount = $cart['discount_amount'] ?? 0;
        $sub_total = $cart['sub_total'];
        $total = $sub_total - $discount;
        
        if($request->paymentMethod == 'cash'){
            if(isVendor()){
                $cod_charges = getSetting('vendor_cod_charges') ?? 0;
            } else {
                $cod_charges = getSetting('cod_charges') ?? 0;
            }

            $cart['cod_charges'] = (float) $cod_charges;
            $cart['total'] =  $total + $cod_charges;
        } else {
            unset($cart['cod_charges']);
            $cart['total'] =  $total;
        }

        session()->put('cart', $cart);

        if (Auth::check()) {
            $userId = Auth::id();
            $userCart = Cart::firstOrCreate(['user_id' => $userId]);
            $userCart->items = json_encode($cart);
            $userCart->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Charges applied successfully.',
            'cart' => $cart
        ], 200);
    }
}

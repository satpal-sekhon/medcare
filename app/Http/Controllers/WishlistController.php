<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productIds = session()->get('wishlist', []);
        $products = Product::select('id', 'primary_category_id', 'category_id', 'brand_id', 'name', 'slug', 'unit', 'thumbnail', 'flag', 'customer_price', 'mrp')->whereIn('id', $productIds)->get();
        return view('frontend.wishlist', compact('products'));
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
        $request->validate([
            'productId' => 'required|exists:products,id',
        ]);

        // Initialize wishlist in session if not already set
        if (!$request->session()->has('wishlist')) {
            $request->session()->put('wishlist', []);
        }

        // Get current wishlist
        $wishlist = $request->session()->get('wishlist');

        // Check if product is already in the wishlist
        if (in_array($request->productId, $wishlist)) {
            // Remove the product from wishlist
            $wishlist = array_diff($wishlist, [$request->productId]);
            $message = 'Removed from wishlist';
        } else {
            // Add product to wishlist
            $wishlist[] = $request->productId;
            $message = 'Added to wishlist';
        }

        $wishlist = array_values($wishlist);
        
        // Update the session
        $request->session()->put('wishlist', array_values($wishlist));
        
        return response()->json(['message' => $message, 'data' => $wishlist, 'success' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}

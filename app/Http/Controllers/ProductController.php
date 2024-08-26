<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Disease;
use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\ProductDisease;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.products');
    }

    /**
     * Display a listing of the admin resource.
     */
    public function admin_index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $primaryCategories = PrimaryCategory::all();
        $brands = Brand::all();
        $diseases = Disease::all();
        return view('admin.products.create', compact('primaryCategories', 'brands', 'diseases'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('images/product-thumbnails', 'public');
        }

        $product = Product::create([
            'primary_category_id' => $request->input('primary_category'),
            'category_id' => $request->input('category'),
            'brand_id' => $request->input('category'),
            'name' => $request->input('name'),
            'thumbnail' => $thumbnailPath,
            'composition' => $request->input('composition'),
            'is_prescription_required' => $request->input('is_prescription_required') ?? 0,
            'stock_status' => $request->input('stock_status'),
            'customer_price' => $request->input('customer_price'),
            'vendor_price' => $request->input('vendor_price'),
            'mrp' => $request->input('mrp'),
            'expiry_date' => $request->input('expiry_date'),
            'short_description' => $request->input('short_description'),
            'ingredients' => $request->input('ingredients'),
            'description' => $request->input('description'),
        ]);

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path
                ]);
            }
        }

        $variants = $request->input('variants');
        if($variants){
            foreach ($variants as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'name' => $variant['variant_name'],
                    'customer_price' => $variant['price_customer'],
                    'vendor_price' => $variant['price_vendor'],
                    'mrp' => $variant['mrp'],
                    'expiry_date' => $variant['expiry_date'],
                ]);
            }
        }

        foreach($request->input('diseases') as $disease){
            ProductDisease::create([
                'product_id' => $product->id,
                'disease_id' => $disease
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

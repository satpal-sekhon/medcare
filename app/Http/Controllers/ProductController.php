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
use Illuminate\Support\Facades\Storage;

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
        $product = null;
        return view('admin.products.create', compact('primaryCategories', 'brands', 'diseases', 'product'));
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
            'brand_id' => $request->input('brand'),
            'name' => $request->input('name'),
            'unit' => $request->input('unit'),
            'thumbnail' => $thumbnailPath,
            'composition' => $request->input('composition'),
            'is_prescription_required' => $request->input('is_prescription_required') ?? 0,
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0,
            'stock_type' => $request->input('stock_type'),
            'stock_quantity_for_customer' => $request->input('stock_quantity_for_customer') ?? 0,
            'stock_quantity_for_vendor' => $request->input('stock_quantity_for_vendor') ?? 0,
            'customer_price' => $request->input('customer_price'),
            'vendor_price' => $request->input('vendor_price'),
            'mrp' => $request->input('mrp'),
            'flag' => $request->input('flag'),
            'product_type' => $request->input('product_type'),
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
                    'stock_quantity_for_customer' => $variant['stock_quantity_for_customer'] ?? 0,
                    'stock_quantity_for_vendor' => $variant['stock_quantity_for_vendor'] ?? 0,
                    'expiry_date' => $variant['expiry_date'],
                ]);
            }
        }

        if($request->input('diseases')){
            foreach($request->input('diseases') as $disease){
                ProductDisease::create([
                    'product_id' => $product->id,
                    'disease_id' => $disease
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!'
        ], 200);
    }

    public function get(Request $request)
    {
        // Define the columns to be used for ordering
        $columns = ['category_name', 'image', 'primary_category_name'];

        // Create the initial query with necessary joins and selects
        $query = Product::query()
            ->select('products.id', 'products.name as category_name', 'products.name', 'products.thumbnail', 'products.customer_price', 'products.vendor_price', 'products.mrp', 'products.stock_type', 'products.stock_quantity_for_customer', 'products.stock_quantity_for_vendor', 'brands.name as brand_name')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id');

        // Apply search filter if present
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('categories.name', 'like', "%{$search}%");
        }

        // Total records count before filtering
        $totalRecords = Product::count();

        // Filtered records count after applying search
        $filteredRecords = $query->count();

        // Apply ordering if specified
        if ($request->has('order')) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderColumn = $columns[$orderColumnIndex] ?? 'category_name'; // Default to 'category_name' if column index is out of bounds
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        // Apply pagination
        $data = $query->skip($request->start)->take($request->length)->get();

        // Return the JSON response
        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    public function searchMedicines(){
        return view('frontend.search-medicines');
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
        $primaryCategories = PrimaryCategory::all();
        $brands = Brand::all();
        $diseases = Disease::all();
        return view('admin.products.edit', compact('product', 'primaryCategories', 'brands', 'diseases'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $thumbnailPath = $product->thumbnail;
        if ($request->hasFile('thumbnail') && Storage::disk('public')->exists($thumbnailPath)) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('images/product-thumbnails', 'public');
        }

        // Update product attributes
        $product->update([
            'primary_category_id' => $request->input('primary_category'),
            'category_id' => $request->input('category'),
            'brand_id' => $request->input('brand'),
            'name' => $request->input('name'),
            'unit' => $request->input('unit'),
            'product_type' => $request->input('product_type'),
            'thumbnail' => $thumbnailPath,
            'composition' => $request->input('composition'),
            'is_prescription_required' => $request->input('is_prescription_required') ?? 0,
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0,
            'stock_type' => $request->input('stock_type'),
            'stock_quantity_for_customer' => $request->input('stock_quantity_for_customer') ?? 0,
            'stock_quantity_for_vendor' => $request->input('stock_quantity_for_vendor') ?? 0,
            'customer_price' => $request->input('customer_price'),
            'vendor_price' => $request->input('vendor_price'),
            'mrp' => $request->input('mrp'),
            'flag' => $request->input('flag'),
            'expiry_date' => $request->input('expiry_date'),
            'short_description' => $request->input('short_description'),
            'ingredients' => $request->input('ingredients'),
            'description' => $request->input('description'),
        ]);

        // Deleted product images
        if($request->input('deleted_images')){
            $deleted_images = explode(',', $request->input('deleted_images'));
            foreach($deleted_images as $deleted_image){
                $product_image = ProductImage::find($deleted_image);
                if($product_image){
                    if ($product_image->path && Storage::disk('public')->exists($product_image->path)) {
                        Storage::disk('public')->delete($product_image->path);
                    }
                    $product_image->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images/products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path
                ]);
            }
        }

        // Handle variants
        $variants = $request->input('variants');
        
        ProductVariant::where('product_id', $product->id)->delete();

        if ($variants) {
            foreach ($variants as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'name' => $variant['variant_name'],
                    'customer_price' => $variant['price_customer'],
                    'vendor_price' => $variant['price_vendor'],
                    'stock_quantity_for_customer' => $variant['stock_quantity_for_customer'] ?? 0,
                    'stock_quantity_for_vendor' => $variant['stock_quantity_for_vendor'] ?? 0,
                    'mrp' => $variant['mrp'],
                    'expiry_date' => $variant['expiry_date'],
                ]);
            }
        }

        // Handle diseases
        ProductDisease::where('product_id', $product->id)->delete();

        if($request->input('diseases')){
            foreach($request->input('diseases') as $disease){
                ProductDisease::create([
                    'product_id' => $product->id,
                    'disease_id' => $disease
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully!'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }

        foreach($product->images as $product_image){
            if ($product_image && Storage::disk('public')->exists($product_image)) {
                Storage::disk('public')->delete($product_image);
            }
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ]);
    }
}

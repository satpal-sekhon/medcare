<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Disease;
use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->limit(16)->withCount(['products as active_products_count' => function($query) {
            $query->where('status', 'Active');
        }])->get();
        $products = Product::where('status', 'Active')->paginate(20);

        // Get the current and last page numbers
        $currentPage = $products->currentPage();
        $lastPage = $products->lastPage();
        
        // Redirect if the current page exceeds the last page
        if ($currentPage > $lastPage) {
            return redirect()->route('brands.index', ['page' => $lastPage]);
        }

        return view('frontend.products', compact('categories', 'products'));
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
        try {
            $request->validate([
                'short_description' => 'required|string',
                'description' => 'required|string',
                'specifications.*.description' => 'required|string',
            ]);
            
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $base_image_path = 'uploads/product-thumbnails/';
                $filename = time().'.'.$request->file('thumbnail')->getClientOriginalExtension();
                $request->file('thumbnail')->move(public_path($base_image_path), $filename);
                        
                $thumbnailPath = $base_image_path.$filename;
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
                'weight' => $request->input('weight'),
                'product_type' => $request->input('product_type'),
                'expiry_date' => $request->input('expiry_date'),
                'short_description' => $request->input('short_description'),
                'meta_description' => $request->input('meta_description'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

            if($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $base_image_path = 'uploads/products/';
                    $filename = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path($base_image_path), $filename);
                    $path = $base_image_path.$filename;

                    $product->images()->create([
                        'path' => $path
                    ]);
                }
            }

            $variants = $request->input('variants');
            if($variants){
                foreach ($variants as $variant) {
                    $product->variants()->create([
                        'name' => $variant['variant_name'],
                        'customer_price' => $variant['price_customer'],
                        'vendor_price' => $variant['price_vendor'],
                        'mrp' => $variant['mrp'],
                        'weight' => $variant['weight'],
                        'stock_quantity_for_customer' => $variant['stock_quantity_for_customer'] ?? 0,
                        'stock_quantity_for_vendor' => $variant['stock_quantity_for_vendor'] ?? 0,
                        'expiry_date' => $variant['expiry_date'],
                    ]);
                }
            }

            $specifications = $request->input('specifications');
            if($specifications){
                foreach ($specifications as $specification) {
                    $product->specifications()->create([
                        'title' => $specification['title'] ?? null,
                        'description' => $specification['description'] ?? null,
                    ]);
                }
            }

            if($request->input('diseases')){
                foreach($request->input('diseases') as $disease){
                    $product->diseases()->create([
                        'disease_id' => $disease
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully!'
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'reason' => 'validation_errors',
                'errors' => $e->errors()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'reason' => 'unknown',
                'message' => $e->getMessage()
            ], 200);
        }
    }

    public function get(Request $request)
    {
        // Define the columns to be used for ordering
        $columns = ['id', 'category_name', 'image', 'primary_category_name'];

        // Create the initial query with necessary joins and selects
        $query = Product::query()
            ->select('products.id', 'products.name as category_name', 'products.name', 'products.thumbnail', 'products.customer_price', 'products.vendor_price', 'products.mrp', 'products.stock_type', 'products.stock_quantity_for_customer', 'products.stock_quantity_for_vendor', 'brands.name as brand_name')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id');

        // Apply search filter if present
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('products.name', 'like', "%{$search}%");
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

    public function searchMedicines(Request $request, $alphabet = 'a'){
        if(!$alphabet){
            $alphabet = $request->query('alphabet');
            $alphabet = substr($alphabet, 0, 1); 

            if(!$alphabet){
                $alphabet = 'a';
            }
        }

        $products = Product::where('name', 'like', $alphabet.'%')
            ->where('product_type', 'Generic')
            ->where('status', 'Active')
            ->paginate(16);

        $alphabets = range('A', 'Z');

        return view('frontend.search-medicines', compact('alphabet', 'alphabets', 'products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $tendingProducts = Product::where('flag', 'Trending')->where('status', 'Active')->where('id', '!=', $product->id)->latest()->limit(6)->get();
        return view('frontend.product', compact('product', 'tendingProducts'));
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
        try {
            $request->validate([
                'short_description' => 'required|string',
                'description' => 'required|string',
                'specifications.*.description' => 'required|string',
            ]);
            
            $thumbnailPath = $product->thumbnail;
            if ($request->hasFile('thumbnail')) {
                // Do not remove the product thumbnail if the product image needs to be shown after the product has been deleted
                /* if ($thumbnailPath && file_exists(public_path($thumbnailPath))) {
                    unlink(public_path($thumbnailPath));
                } */

                $base_image_path = 'uploads/product-thumbnails/';
                $filename = time().'.'.$request->file('thumbnail')->getClientOriginalExtension();
                $request->file('thumbnail')->move(public_path($base_image_path), $filename);
                        
                $thumbnailPath = $base_image_path.$filename;
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
                'weight' => $request->input('weight'),
                'flag' => $request->input('flag'),
                'expiry_date' => $request->input('expiry_date'),
                'short_description' => $request->input('short_description'),
                'meta_description' => $request->input('meta_description'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
            ]);

            // Deleted product images
            if($request->input('deleted_images')){
                $deleted_images = explode(',', $request->input('deleted_images'));

                foreach($deleted_images as $deleted_image){
                    $product_image = ProductImage::find($deleted_image);
                    
                    if($product_image){
                        if ($product_image->path && file_exists(public_path($product_image->path))) {
                            unlink(public_path($product_image->path));
                        }

                        $product_image->delete();
                    }
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $base_image_path = 'uploads/products/';
                    $filename = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path($base_image_path), $filename);
                    $path = $base_image_path.$filename;

                    $product->images()->create([
                        'path' => $path
                    ]);
                }
            }

            // Handle variants
            $variants = $request->input('variants');
            $product->variants()->delete();

            if ($variants) {
                foreach ($variants as $variant) {
                    $product->variants()->create([
                        'name' => $variant['variant_name'],
                        'customer_price' => $variant['price_customer'],
                        'vendor_price' => $variant['price_vendor'],
                        'stock_quantity_for_customer' => $variant['stock_quantity_for_customer'] ?? 0,
                        'stock_quantity_for_vendor' => $variant['stock_quantity_for_vendor'] ?? 0,
                        'mrp' => $variant['mrp'],
                        'weight' => $variant['weight'] ?? 0,
                        'expiry_date' => $variant['expiry_date'],
                    ]);
                }
            }

            // Handle product specifications
            $product->specifications()->delete();

            $specifications = $request->input('specifications');
            if($specifications){
                foreach ($specifications as $specification) {
                    $product->specifications()->create([
                        'title' => $specification['title'] ?? null,
                        'description' => $specification['description'] ?? null,
                    ]);
                }
            }

            // Handle diseases
            $product->diseases()->delete();

            if($request->input('diseases')){
                foreach($request->input('diseases') as $disease){
                    $product->diseases()->create([
                        'disease_id' => $disease
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully!'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'reason' => 'validation_errors',
                'errors' => $e->errors()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'reason' => 'unknown',
                'message' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Do not remove the product thumbnail if the product image needs to be shown after the product has been deleted
        /* if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
            unlink(public_path($product->thumbnail));
        } */

        foreach($product->images as $product_image){
            if ($product_image && file_exists(public_path($product_image))) {
                unlink(public_path($product_image));
            }
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ]);
    }
}

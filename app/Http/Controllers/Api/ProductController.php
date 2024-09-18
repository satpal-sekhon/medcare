<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Default values
        $defaultSortColumn = 'name';
        $defaultSortDirection = 'asc';
        $defaultPerPage = 18;

        // Allowed sort columns
        $allowedSortColumns = [
            'id',
            'name',
            'slug',
            'thumbnail',
            'product_type',
            'stock_type',
            'stock_quantity_for_customer',
            'stock_quantity_for_vendor',
            'customer_price',
            'vendor_price',
            'mrp'
        ];

        // Allowed product types
        $allowedProductTypes = ['General', 'Generic'];

        // Extract parameters from the request
        $sortColumn = $request->input('sort_column', $defaultSortColumn);
        $sortDirection = $request->input('sort_direction', $defaultSortDirection);
        $perPage = (int) $request->input('per_page', $defaultPerPage);
        $paginate = filter_var($request->input('paginate', true), FILTER_VALIDATE_BOOLEAN); // Default to true for pagination

        // Extract and normalize filter parameters from the request
        $brandIds = $request->input('brand_ids', []);
        $categoryIds = $request->input('category_ids', []);
        $primaryCategoryIds = $request->input('primary_category_ids', []);
        $productTypes = $request->input('product_types', []);
        $diseaseIds = $request->input('disease_ids', []); // New filter for diseases
        $nameStartsWith = $request->input('name_starts_with', '');
        $search = $request->input('search', '');

        // Ensure filters are arrays
        $brandIds = is_array($brandIds) ? $brandIds : explode(',', $brandIds);
        $categoryIds = is_array($categoryIds) ? $categoryIds : explode(',', $categoryIds);
        $primaryCategoryIds = is_array($primaryCategoryIds) ? $primaryCategoryIds : explode(',', $primaryCategoryIds);
        $productTypes = is_array($productTypes) ? $productTypes : explode(',', $productTypes);
        $diseaseIds = is_array($diseaseIds) ? $diseaseIds : explode(',', $diseaseIds);

        // Validate and sanitize sort column
        $sortColumn = in_array($sortColumn, $allowedSortColumns) ? $sortColumn : $defaultSortColumn;

        // Validate sort direction
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : $defaultSortDirection;

        // Validate per_page
        $perPage = max(1, $perPage); // Ensure perPage is at least 1

        // Validate and sanitize product types
        $productTypes = array_filter($productTypes, function ($type) use ($allowedProductTypes) {
            return in_array($type, $allowedProductTypes);
        });

        // Validate and sanitize name_starts_with
        $nameStartsWith = trim($nameStartsWith);
        $nameStartsWith = preg_replace('/[^a-zA-Z]/', '', $nameStartsWith); // Allow only letters

        // Validate and sanitize search term
        $search = trim($search);
        $search = preg_replace('/[^a-zA-Z0-9\s]/', '', $search); // Allow letters, numbers, and spaces

        // Build the query
        $query = Product::select(
            'id',
            'brand_id',
            'category_id',
            'primary_category_id',
            'name',
            'slug',
            'thumbnail',
            'unit',
            'flag',
            'composition',
            'product_type',
            'stock_type',
            'stock_quantity_for_customer',
            'stock_quantity_for_vendor',
            'customer_price',
            'vendor_price',
            'mrp'
        )
            ->with([
                'brand:id,name,slug',
                'category:id,name,slug',
                'primaryCategory:id,name,slug'
            ])
            ->orderBy($sortColumn, $sortDirection);

        // Apply filters
        if (!empty($brandIds)) {
            $query->whereIn('brand_id', $brandIds);
        }

        if (!empty($categoryIds)) {
            $query->whereIn('category_id', $categoryIds);
        }
        
        if (!empty($primaryCategoryIds)) {
            $query->whereIn('primary_category_id', $primaryCategoryIds);
        }

        if (!empty($productTypes)) {
            $query->whereIn('product_type', $productTypes);
        }

        if (!empty($diseaseIds)) {
            $query->whereHas('diseases', function ($q) use ($diseaseIds) {
                $q->whereIn('id', $diseaseIds);
            });
        }

        if (!empty($nameStartsWith)) {
            $query->where('name', 'like', $nameStartsWith . '%');
        }

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('composition', 'like', '%' . $search . '%');
            });
        }

        if ($paginate) {
            // Ensure $perPage is defined and a valid integer
            $perPage = $perPage > 0 ? $perPage : 15; // Default to 15 if $perPage is not set or invalid
        
            // Count the total number of products matching the filters
            $total = $query->count();
            $currentPage = max(1, (int) $request->input('page', 1)); // Ensure currentPage is at least 1
        
            // Get the products for the current page
            $products = $query->forPage($currentPage, $perPage)->get();
        
            // Calculate pagination metadata
            $lastPage = (int) ceil($total / $perPage);
            $pagination = [
                'total' => $total, // Total number of products
                'per_page' => $perPage,
                'current_page' => $currentPage,
                'last_page' => $lastPage,
                'from' => $total > 0 ? (($currentPage - 1) * $perPage) + 1 : null,
                'to' => $total > 0 ? min($total, $currentPage * $perPage) : null,
            ];
        } else {
            $products = $query->get();
            $pagination = null; // No pagination metadata when not paginated
        }
        
        return response()->json([
            'data' => $products,
            'meta' => $pagination,
        ]);        
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
    public function show(Product $product)
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

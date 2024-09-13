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
        $perPage = $request->input('per_page', $defaultPerPage);
        $paginate = filter_var($request->input('paginate', true), FILTER_VALIDATE_BOOLEAN); // Default to true for pagination

        // Extract and normalize filter parameters from the request
        $brandIds = $request->input('brand_ids', []);
        $categoryIds = $request->input('category_ids', []);
        $primaryCategoryIds = $request->input('primary_category_ids', []);
        $productTypes = $request->input('product_types', []); // New filter for product types

        // Ensure filters are arrays
        $brandIds = is_array($brandIds) ? $brandIds : explode(',', $brandIds);
        $categoryIds = is_array($categoryIds) ? $categoryIds : explode(',', $categoryIds);
        $primaryCategoryIds = is_array($primaryCategoryIds) ? $primaryCategoryIds : explode(',', $primaryCategoryIds);
        $productTypes = is_array($productTypes) ? $productTypes : explode(',', $productTypes); // Normalize product types

        // Validate and sanitize sort column
        $sortColumn = in_array($sortColumn, $allowedSortColumns) ? $sortColumn : $defaultSortColumn;

        // Validate sort direction
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : $defaultSortDirection;

        // Validate per_page
        $perPage = filter_var($perPage, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: $defaultPerPage;

        // Validate and sanitize product types
        $productTypes = array_filter($productTypes, function ($type) use ($allowedProductTypes) {
            return in_array($type, $allowedProductTypes);
        });

        // Build the query
        $query = Product::select(
            'id',
            'brand_id',
            'category_id',
            'primary_category_id',
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

        if (!empty($productTypes)) { // Apply product_type filter
            $query->whereIn('product_type', $productTypes);
        }

        // Apply pagination if needed
        if ($paginate) {
            $products = $query->paginate($perPage);
        } else {
            $products = $query->get(); // Get all records if pagination is not required
        }

        return response()->json($products);
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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

        // Extract parameters from the request
        $sortColumn = $request->input('sort_column', $defaultSortColumn);
        $sortDirection = $request->input('sort_direction', $defaultSortDirection);
        $perPage = $request->input('per_page', $defaultPerPage);
        $paginate = $request->input('paginate', true); // Default to true for pagination
        $search = $request->input('search'); // Search term (optional)
        $primaryCategoryIds = $request->input('primary_category_ids'); // Array of primary category IDs
        $categoryIds = $request->input('category_ids'); // Array of category IDs

        // Validate sort direction
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : $defaultSortDirection;

        // Validate primary category IDs and category IDs
        if ($primaryCategoryIds) {
            $primaryCategoryIds = is_array($primaryCategoryIds) ? $primaryCategoryIds : explode(',', $primaryCategoryIds);
            $primaryCategoryIds = array_filter($primaryCategoryIds, 'is_numeric');
        } else {
            $primaryCategoryIds = [];
        }

        if ($categoryIds) {
            $categoryIds = is_array($categoryIds) ? $categoryIds : explode(',', $categoryIds);
            $categoryIds = array_filter($categoryIds, 'is_numeric');
        } else {
            $categoryIds = [];
        }

        // Build the query
        $query = Brand::select('brands.id', 'brands.name', 'brands.slug', 'brands.image')
            ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
            ->selectRaw('COUNT(products.id) as products_count')
            ->groupBy('brands.id', 'brands.name', 'brands.slug', 'brands.image')
            ->when($search, function ($query, $search) {
                return $query->where('brands.name', 'like', '%' . $search . '%');
            })
            ->when($primaryCategoryIds, function ($query, $primaryCategoryIds) {
                return $query->whereIn('products.primary_category_id', $primaryCategoryIds);
            })
            ->when($categoryIds, function ($query, $categoryIds) {
                return $query->whereIn('products.category_id', $categoryIds);
            })
            ->orderBy('brands.' . $sortColumn, $sortDirection); // Specify table alias here

        if ($paginate) {
            // Count the total number of records matching the filters
            $total = $query->count();

            // Get the current page from the request, defaulting to 1 if not provided
            $currentPage = max(1, (int) $request->input('page', 1));

            // Calculate the offset for the current page
            $offset = ($currentPage - 1) * $perPage;

            // Retrieve the items for the current page
            $items = $query->skip($offset)->take($perPage)->get();

            // Calculate pagination metadata
            $pagination = [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $currentPage,
                'last_page' => (int) ceil($total / $perPage),
                'from' => $total > 0 ? (($currentPage - 1) * $perPage) + 1 : null,
                'to' => $total > 0 ? min($total, $currentPage * $perPage) : null,
            ];
        } else {
            // Retrieve all records if pagination is not required
            $items = $query->get();
            $pagination = null; // No pagination metadata when not paginated
        }

        // Construct the response
        $response = [
            'data' => $items,
        ];

        if ($paginate) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response);
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
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}

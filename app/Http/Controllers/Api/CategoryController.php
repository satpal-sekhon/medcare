<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Default values
        $defaultSortColumn = 'name';
        $defaultSortDirection = 'asc';
        $defaultPerPage = 10;

        // Extract parameters from the request
        $sortColumn = $request->input('sort_column', $defaultSortColumn);
        $sortDirection = $request->input('sort_direction', $defaultSortDirection);
        $perPage = $request->input('per_page', $defaultPerPage);
        $paginate = $request->input('paginate', true); // Default to true for pagination
        $primaryCategoryIds = $request->input('primary_category_ids'); // Array of primary category IDs
        $search = $request->input('search'); // Search term

        // Validate sort direction
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : $defaultSortDirection;

        // Validate primary category IDs
        if ($primaryCategoryIds) {
            $primaryCategoryIds = is_array($primaryCategoryIds) ? $primaryCategoryIds : explode(',', $primaryCategoryIds);
            $primaryCategoryIds = array_filter($primaryCategoryIds, 'is_numeric');
        } else {
            $primaryCategoryIds = [];
        }

        // Build the query
        $query = Category::select('categories.id', 'categories.primary_category_id', 'categories.name', 'categories.slug', 'categories.image')
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->selectRaw('COUNT(products.id) as products_count')
            ->groupBy('categories.id', 'categories.primary_category_id', 'categories.name', 'categories.slug', 'categories.image')
            ->when($search, function ($query, $search) {
                return $query->where('categories.name', 'like', '%' . $search . '%');
            })
            ->when($primaryCategoryIds, function ($query, $primaryCategoryIds) {
                return $query->whereIn('categories.primary_category_id', $primaryCategoryIds);
            })
            ->orderBy($sortColumn, $sortDirection);

        if ($paginate) {
            // Use Laravel's paginate method
            $items = $query->paginate($perPage);
            $response = [
                'data' => $items->items(),
                'pagination' => [
                    'total' => $items->total(),
                    'per_page' => $items->perPage(),
                    'current_page' => $items->currentPage(),
                    'last_page' => $items->lastPage(),
                    'from' => $items->firstItem(),
                    'to' => $items->lastItem(),
                ],
            ];
        } else {
            // Retrieve all records if pagination is not required
            $items = $query->get();
            $response = [
                'data' => $items,
                'pagination' => null, // No pagination metadata when not paginated
            ];
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}

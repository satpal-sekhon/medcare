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
        $primaryCategoryId = $request->input('primary_category_id'); // Filter by primary category

        // Validate sort direction
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : $defaultSortDirection;

        // Build the query
        $query = Category::select('id', 'primary_category_id', 'name', 'slug', 'image')
            ->orderBy($sortColumn, $sortDirection);

        // Apply primary category filter if provided
        if ($primaryCategoryId) {
            $query->where('primary_category_id', $primaryCategoryId);
        }

        // Apply pagination or get all records
        if ($paginate) {
            $categories = $query->paginate($perPage);
        } else {
            $categories = $query->get(); // Get all records if pagination is not required
        }

        return response()->json($categories);
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

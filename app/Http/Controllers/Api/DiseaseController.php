<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
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

        // Validate sort direction
        $sortDirection = in_array($sortDirection, ['asc', 'desc']) ? $sortDirection : $defaultSortDirection;

        // Build the query
        $query = Disease::select('id', 'name', 'slug', 'image')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($sortColumn, $sortDirection);

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
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disease $disease)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disease $disease)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class PharmacyController extends Controller
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
        $query = Vendor::select('vendors.id', 'vendors.name', 'vendors.address', 'vendors.city', 'vendors.pincode', 'vendors.slug', 'vendors.image')
            ->join('users', 'vendors.user_id', '=', 'users.id')
            ->where('users.status', 'Active')
            ->where('vendors.type', 'Pharmacy Store')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('vendors.name', 'like', '%' . $search . '%')
                        ->orWhere('vendors.address', 'like', '%' . $search . '%')
                        ->orWhere('vendors.city', 'like', '%' . $search . '%')
                        ->orWhere('vendors.pincode', 'like', '%' . $search . '%');
                });
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
            $response['meta'] = $pagination;
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
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}

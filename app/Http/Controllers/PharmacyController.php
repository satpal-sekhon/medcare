<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.pharmacy');
    }

    public function admin_index()
    {
        return view('admin.pharmacy-stores.index');
    }

    public function get(Request $request)
    {
        $columns = ['name', 'email', 'phone_number', 'status'];

        $query = Vendor::query()
            ->where('type', 'Pharmacy Store')
            ->whereHas('user', function ($q) {
                $q->where('status', 'Active');
            });

        // Filter by role if specified
        if ($request->has('role') && !empty($request->role)) {
            $role = $request->role;
            $query->whereHas('user.roles', function ($q) use ($role) {
                $q->where('name', $role);
            });
        }

        // Handle search filtering
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        // Get total record count before pagination
        $totalRecords = $query->count();
        $filteredRecords = $totalRecords; // Initial filtered records count before ordering and pagination

        // Apply ordering
        if ($request->has('order') && isset($request->order[0]['column'])) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderDirection = $request->order[0]['dir'];

            if (isset($columns[$orderColumnIndex])) {
                $orderColumn = $columns[$orderColumnIndex];
                $query->orderBy($orderColumn, $orderDirection);
            }
        }

        // Get filtered record count after filtering
        $filteredRecords = $query->count();

        // Apply pagination
        $data = $query->skip($request->start)->take($request->length)->get();

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Vendor $pharmacy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pharmacy = Vendor::find($id);
        
        // Check if the Vendor was found
        if (!$pharmacy) {
            return redirect()->route('admin.pharmacy-stores.index')->with('error', 'Pharmacy not found.');
        }
        
        $states = State::all();
        return view('admin.pharmacy-stores.edit', compact('pharmacy', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pharmacy = Vendor::find($id);
        
        // Check if the Vendor was found
        if (!$pharmacy) {
            return redirect()->route('admin.pharmacy-stores.index')->with('error', 'Pharmacy not found.');
        }

        $request->validate([
            'name'      => 'required|string|max:75',
            'email'     => [
                            'required',
                            'email',
                            'max:100',
                            Rule::unique('vendors', 'email')->ignore($pharmacy->id),
                        ],
            'phone_number' => [
                            'required',
                            'digits:10',
                            Rule::unique('vendors', 'phone_number')->ignore($pharmacy->id),
                        ],
            'address'       => 'required|string|max:255',
            'city'          => 'required|string|max:50',
            'pincode'       => 'required|digits:6',
            'state'         => 'required|string|max:50',
            'store_image'   => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $storeImagePath = $pharmacy->image;
        if ($request->hasFile('store_image')) {
            $storeImage = $request->file('store_image');
            $storeImagePath = uploadFile($storeImage, 'uploads/stores/');
        }

        $pharmacy->update([
            'name'              => $request->input('name'),
            'email'             => $request->input('email'),
            'phone_number'      => preg_replace('/\D/', '', $request->input('phone_number')),
            'address'           => $request->input('address'),
            'city'              => $request->input('city'),
            'state'             => $request->input('state'),
            'image'             => $storeImagePath,
            'pincode'           => $request->input('pincode'),
            'shop_type'         => $request->input('shop_type'),
        ]);

        return redirect()->route('admin.pharmacy-stores.index')->with('success', 'Pharmacy Store updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $pharmacy)
    {
        //
    }
}

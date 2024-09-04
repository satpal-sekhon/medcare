<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index(){
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:users,email',
            'phone_number' => 'required|digits:10',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:password'
        ]);

        // Save the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => preg_replace('/\D/', '', $request->input('phone_number')),
            'password' => Hash::make($request->input('password')),
        ]);
        // Assign role to user
        $user->assignRole($request->role);

        // Redirect or return a success response
        $route_name = 'admin.users.index';
        if($request->role=='Vendor'){
            $route_name = 'admin.vendors.index';
        }
        return redirect()->route($route_name)->with('success', 'User saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['name', 'email', 'phone_number'];

        $query = User::query();

        // Filter by role if specified
        if ($request->has('role') && !empty($request->role)) {
            $role = $request->role;
            $query->whereHas('roles', function($q) use ($role) {
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
        $filteredRecords = $query->count();

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
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $states = State::select('name')->get();
        return view('admin.users.edit', compact('user', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone_number' => 'required|digits:10',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:50',
            'pincode' => [
                'nullable',
                'regex:/^\d{6}$/',
            ],
            'state' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => preg_replace('/\D/', '', $request->input('phone_number')),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'state' => $request->input('state'),
        ];

        // Only add the password to the update data if it is provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Update the user
        $user->update($data);
        
        $route_name = 'admin.users.index';
        if ($request->role === 'Vendor') {
            $route_name = 'admin.vendors.index';
        }

        return redirect()->route($route_name)->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->profile_pic && Storage::disk('public')->exists($user->profile_pic)) {
            Storage::disk('public')->delete($user->profile_pic);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.'
        ]);
    }
}

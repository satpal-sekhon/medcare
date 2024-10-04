<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\State;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function suspended_users(){
        return view('admin.users.suspended');
    }

    public function user_orders(User $user)
    {
        $totalOrdersCount = $user->orders()->count();
        $quickOrdersCount = $user->quickOrders()->count();
        $doctorConsultationOrdersCount = $user->doctorConsultationOrders()->count();
        $labPackageOrdersCount = $user->labPackageOrders()->count();

        return view('admin.users.orders', compact('user', 'totalOrdersCount', 'quickOrdersCount', 'doctorConsultationOrdersCount', 'labPackageOrdersCount'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    public function sendNotification(Request $request){
        $user = User::find($request->user_id);

        $user->notify(new UserNotification($request->message));

        $data = [
            'notificationMessage' => $request->message
        ];

        $subject = 'New Notification from '.getSetting('site_name');

        Mail::to($user->email)->send(new SendMail($data, $subject, 'notification'));

        return response()->json([
            'success' => true,
            'message' => $request->message
        ]);
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
            $route_name = 'vendor.index';
        }
        return redirect()->route($route_name)->with('success', 'User saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['name', 'email', 'phone_number', 'status'];

        $query = User::query()->withCount('orders','labPackageOrders', 'quickOrders', 'doctorConsultationOrders');

        // Filter by role if specified
        if ($request->has('role') && !empty($request->role)) {
            $role = $request->role;
            $query->whereHas('roles', function($q) use ($role) {
                $q->where('name', $role);
            });

            if ($role === 'Vendor') {
                $query->with('vendor');
            }            
        }

        // Filter by status if specified
        if ($request->has('status')) {
            $status = $request->input('status');

            // Special case for 'Pending Approval'
            if ($status === 'Pending Approval' && !$request->input('new_registrations')) {
                $query->whereHas('vendor', function ($q) {
                    $q->whereNotNull('image');
                });
            } else if($status === 'Pending Approval' && $request->input('new_registrations')){
                $query->whereHas('vendor', function ($q) {
                    $q->whereNull('image');
                });
            }
        
            // Apply the status filter
            $query->where('status', $status);
        }


        if ($request->has('status_exclude')) {
            $status = $request->input('status_exclude');
            $query->where('status', '!=', $status);
        }

        // Handle search filtering
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('user_code', 'like', "%{$search}%")
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
            'status' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => preg_replace('/\D/', '', $request->input('phone_number')),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'pincode' => $request->input('pincode'),
            'state' => $request->input('state'),
            'status' => $request->input('status'),
        ];

        // Only add the password to the update data if it is provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Update the user
        $user->update($data);
        
        $route_name = 'admin.users.index';
        if ($request->role === 'Vendor') {
            $route_name = 'vendor.index';
        }

        return redirect()->route($route_name)->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $profilePic = $user->profile_pic;

        if ($profilePic && file_exists(public_path($profilePic))) {
            unlink(public_path($profilePic));
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully.'
        ]);
    }
}

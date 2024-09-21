<?php

namespace App\Http\Controllers;

use App\Models\LabPackage;
use App\Models\LabPackageOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LabPackageOrderConfirmation;

class LabPackageOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index(){
        return view('admin.orders.lab-package-orders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.book-lab-package', compact('labPackage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $request->validate([
            'lab_package_id' => 'required|integer',
            'customer_name' => 'required|string|max:50',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email|max:100',
            'instructions' => 'nullable|string',
        ]);

        $labPackage = LabPackage::find($request->input('lab_package_id'));

        try {
            LabPackageOrder::create([
                'user_id' => $request->user()->id ?? null,
                'lab_package_id' => $request->input('lab_package_id'),
                'name' => $request->input('customer_name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'instructions' => $request->input('instructions'),
                'package_name' => $labPackage->name,
                'package_title' => $labPackage->package_title,
                'package_image' => $labPackage->image,
                'package_amount' => $labPackage->amount,
                'included_tests' => json_encode($labPackage->labTests->pluck('name')->toArray()),
                'status' => 'Awaiting Confirmation',
            ]);

            $data = [
                'name' => $request->input('customer_name'),
                'package_name' => $labPackage->name,
                'package_title' => $labPackage->package_title,
                'package_amount' => $labPackage->amount,
                'included_tests' => json_encode($labPackage->labTests->pluck('name')->toArray()),
                'instructions' => $labPackage->instructions,
            ];

            Mail::to($request->email)->send(new LabPackageOrderConfirmation($data, 'emails.lab-package-order-confirmation'));

            if($request->user()){
                return redirect()->route('my-account.orders')->with('success', 'Lab package booked successfully!');
            }

            return redirect()->route('lab-package.show', $request->input('lab_package_id'))->with('success', 'Lab package booked successfully!');
        } catch (\Exception $e) {    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to send email');
        } 
    
    }

    public function get(Request $request){
        $columns = ['id', 'name', 'email', 'phone_number'];

        $query = LabPackageOrder::query();

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        if($request->has('user_id')){
            $user_id = $request->user_id;
            $query->where(function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            });
        }
        
        $totalRecords = $query->count();
        $filteredRecords = $query->count();

        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

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
    public function show(LabPackageOrder $labPackageOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabPackageOrder $labPackageOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabPackageOrder $labPackageOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabPackageOrder $labPackageOrder)
    {
        $labPackageOrder->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Lab package deleted successfully.'
        ], 200);
    }
}

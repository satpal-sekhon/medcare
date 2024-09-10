<?php

namespace App\Http\Controllers;

use App\Models\QuickOrder;
use Illuminate\Http\Request;

class QuickOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.quick-order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email|max:100',
            'prescription' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'instructions' => 'nullable|string',
        ]);

        $prescriptionPath = null;
        $mimeType = null;
        if ($request->hasFile('prescription')) {
            $base_image_path = 'uploads/prescriptions/';
            $filename = time().'.'.$request->file('prescription')->getClientOriginalExtension();
            $mimeType = $request->file('prescription')->getMimeType();
            $request->file('prescription')->move(public_path($base_image_path), $filename);
                    
            $prescriptionPath = $base_image_path.$filename;
        }

        QuickOrder::create([
            'user_id' => $request->user()->id ?? null,
            'name' => $request->input('customer_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'prescription_path' => $prescriptionPath,
            'mime_type' => $mimeType,
            'instructions' => $request->input('instructions'),
        ]);

        if($request->user()){
            return redirect()->route('my-account.orders')->with('success', 'Quick order placed successfully!');
        }

        return redirect()->back()->with('success', 'Quick order placed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuickOrder $quickOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuickOrder $quickOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuickOrder $quickOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuickOrder $quickOrder)
    {
        //
    }
}

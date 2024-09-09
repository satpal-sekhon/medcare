<?php

namespace App\Http\Controllers;

use App\Models\LabPackage;
use App\Models\LabPackageOrder;
use Illuminate\Http\Request;

class LabPackageOrderController extends Controller
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
            'included_tests' => json_encode($labPackage->labTests->pluck('name')->toArray())
        ]);

        if($request->user()){
            return redirect()->route('my-account.orders')->with('success', 'Lab package booked successfully!');
        }

        return redirect()->route('lab-package.show', $request->input('lab_package_id'))->with('success', 'Lab package booked successfully!');
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
        //
    }
}

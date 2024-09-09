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
            'prescription' => 'required|image|mimes:jpeg,png,jpg,gif',
            'instructions' => 'nullable|string',
        ]);

        dd($request->all());
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

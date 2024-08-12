<?php

namespace App\Http\Controllers;

use App\Models\PrimaryCategory;
use Illuminate\Http\Request;

class PrimaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_primary_categories_index(){
        return view('admin.primary-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.primary-categories.create');
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
    public function show(PrimaryCategory $primaryCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrimaryCategory $primaryCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrimaryCategory $primaryCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrimaryCategory $primaryCategory)
    {
        //
    }
}

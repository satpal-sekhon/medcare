<?php

namespace App\Http\Controllers;

use App\Models\LabPackage;
use Illuminate\Http\Request;

class LabPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index(){
        return view('admin.lab-packages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lab-packages.create');
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
    public function show(LabPackage $labPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabPackage $labPackage)
    {
        return view('admin.lab-packages.edit', compact('labPackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabPackage $labPackage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabPackage $labPackage)
    {
        //
    }
}

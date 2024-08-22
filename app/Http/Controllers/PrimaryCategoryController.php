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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/primary-categories', 'public');
        }

        PrimaryCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath
        ]);

        return redirect()->route('admin.primary-categories.index')->with('success', 'Primary category saved successfully!');
    }

    public function get(Request $request){
        $columns = ['name', 'image']; // Define the columns

        $query = PrimaryCategory::query();

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('name', 'like', "%{$search}%");
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
        PrimaryCategory::where('id', $primaryCategory->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Primary category deleted successfully.'
        ]);
    }
}

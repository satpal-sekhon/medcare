<?php

namespace App\Http\Controllers;

use App\Models\PrimaryCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrimaryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_primary_categories_index()
    {
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
            'name' => 'required|string|max:100|unique:primary_categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = uploadFile($request->file('image'), 'uploads/primary-categories/');
        }

        $bannerImagePath = null;
        if ($request->hasFile('banner_image')) {
            $bannerImagePath = uploadFile($request->file('banner_image'), 'uploads/banners/primary-categories/');
        }

        PrimaryCategory::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'banner_image' => $bannerImagePath,
            'description' => $request->input('description'),
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.primary-categories.index')->with('success', 'Primary category saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'image'];

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
        return view('admin.primary-categories.edit', compact('primaryCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrimaryCategory $primaryCategory)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('primary_categories')->ignore($primaryCategory->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = $primaryCategory->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $imagePath = uploadFile($request->file('image'), 'uploads/primary-categories/');
        }

        $bannerImagePath = $primaryCategory->image;
        if ($request->hasFile('banner_image')) {
            if ($bannerImagePath && file_exists(public_path($bannerImagePath))) {
                unlink(public_path($bannerImagePath));
            }

            $bannerImagePath = uploadFile($request->file('banner_image'), 'uploads/banners/primary-categories/');
        }

        $primaryCategory->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'banner_image' => $bannerImagePath,
            'description' => $request->input('description'),
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.primary-categories.index')->with('success', 'Primary Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrimaryCategory $primaryCategory)
    {
        $imagePath = $primaryCategory->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $primaryCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Primary category deleted successfully.'
        ]);
    }
}

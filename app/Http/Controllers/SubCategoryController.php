<?php

namespace App\Http\Controllers;

use App\Models\PrimaryCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_subcategories_index(){
        return view('admin.sub-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $primaryCategories = PrimaryCategory::all();
        return view('admin.sub-categories.create', compact('primaryCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'primary_category' => 'required',
            'category' => 'required',
            'name' => 'required|string|max:255|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/sub-categories', 'public');
        }

        SubCategory::create([
            'primary_category_id' => $request->input('primary_category'),
            'category_id' => $request->input('category'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath
        ]);

        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category saved successfully!');
    }

    public function get(Request $request)
    {
        // Define the columns to be used for ordering
        $columns = ['category_name', 'image', 'primary_category_name'];

        // Create the initial query with necessary joins and selects
        $query = SubCategory::query()
            ->select('sub_categories.id', 'sub_categories.name as category_name', 'sub_categories.name', 'sub_categories.image', 'primary_categories.name as primary_category_name')
            ->leftJoin('primary_categories', 'sub_categories.primary_category_id', '=', 'primary_categories.id')
            ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id'); // Adjust according to your actual join condition

        // Apply search filter if present
        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('categories.name', 'like', "%{$search}%");
        }

        // Total records count before filtering
        $totalRecords = SubCategory::count();

        // Filtered records count after applying search
        $filteredRecords = $query->count();

        // Apply ordering if specified
        if ($request->has('order')) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderColumn = $columns[$orderColumnIndex] ?? 'category_name'; // Default to 'category_name' if column index is out of bounds
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        // Apply pagination
        $data = $query->skip($request->start)->take($request->length)->get();

        // Return the JSON response
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
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $primaryCategories = PrimaryCategory::all();
        return view('admin.sub-categories.edit', compact('subCategory', 'primaryCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'primary_category' => 'required',
            'category' => 'required',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories')->ignore($subCategory->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = $subCategory->image;

        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('images/sub-categories', 'public');
        }

        $subCategory->update([
            'primary_category_id' => $request->input('primary_category'),
            'category_id' => $request->input('category'),
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $imagePath = $subCategory->image;

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $subCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sub Category deleted successfully.'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PrimaryCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_categories_index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $primaryCategories = PrimaryCategory::all();
        return view('admin.categories.create', compact('primaryCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'primary_category' => 'required',
            'name' => 'required|string|max:255|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/categories', 'public');
        }

        Category::create([
            'primary_category_id' => $request->input('primary_category'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['name', 'image', 'primary_category_name'];

        $query = Category::query()
            ->select('categories.id', 'categories.name', 'categories.image')
            ->leftJoin('primary_categories', 'categories.primary_category_id', '=', 'primary_categories.id')
            ->addSelect('primary_categories.name as primary_category_name');

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('categories.name', 'like', "%{$search}%");
        }

        // Total records count before filtering
        $totalRecords = Category::count();

        // Filtered records count after applying search
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

    function getByPrimaryCategory(Request $request)
    {
        $categories = Category::select('id', 'name')->where('primary_category_id', $request->category_id)->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $primaryCategories = PrimaryCategory::all();
        return view('admin.categories.edit', compact('category', 'primaryCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'primary_category' => 'required',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = $category->image;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('images/categories', 'public');
        }

        $category->update([
            'primary_category_id' => $request->input('primary_category'),
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $imagePath = $category->image;

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        Category::where('id', $category->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ]);
    }
}

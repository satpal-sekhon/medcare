<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PrimaryCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'string',
                'max:100',
                function ($attribute, $value, $fail) use ($request) {
                    $primaryCategoryId = $request->input('primary_category');
        
                    $exists = Category::where('name', $value)
                        ->where('primary_category_id', $primaryCategoryId)
                        ->exists();
        
                    if ($exists) {
                        $fail('The '.$attribute.' has already been taken in the selected category.');
                    }
                }
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = uploadFile($request->file('image'), 'uploads/categories/');
        }

        $bannerImagePath = null;
        if ($request->hasFile('banner_image')) {
            $bannerImagePath = uploadFile($request->file('banner_image'), 'uploads/banners/categories/');
        }

        Category::create([
            'primary_category_id' => $request->input('primary_category'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'banner_image' => $bannerImagePath,
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['name', 'image', 'primary_category_name'];

        $query = Category::query()
            ->select('categories.id', 'categories.name', 'categories.show_on_homepage', 'categories.image', 'categories.banner_image')
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
        return view('frontend.category', compact('category'));
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
                'max:100',
                function ($attribute, $value, $fail) use ($request) {
                    $primaryCategoryId = $request->input('primary_category');
                    $categoryId = $request->route('category')->id; // Adjust this based on how you get the category ID

                    $exists = Category::where('name', $value)
                        ->where('primary_category_id', $primaryCategoryId)
                        ->where('id', '!=', $categoryId) // Ignore the current category if updating
                        ->exists();

                    if ($exists) {
                        $fail('The '.$attribute.' has already been taken in the selected category.');
                    }
                },
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = $category->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $imagePath = uploadFile($request->file('image'), 'uploads/categories/');
        }

        $bannerImagePath = $category->banner_image;
        if ($request->hasFile('banner_image')) {
            if ($bannerImagePath && file_exists(public_path($bannerImagePath))) {
                unlink(public_path($bannerImagePath));
            }

            $bannerImagePath = uploadFile($request->file('banner_image'), 'uploads/banners/categories/');
        }

        $category->update([
            'primary_category_id' => $request->input('primary_category'),
            'name' => $request->input('name'),
            'image' => $imagePath,
            'banner_image' => $bannerImagePath,
            'description' => $request->input('description'),
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $imagePath = $category->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $bannerImagePath = $category->banner_image;

        if ($bannerImagePath && file_exists(public_path($bannerImagePath))) {
            unlink(public_path($bannerImagePath));
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ]);
    }
}

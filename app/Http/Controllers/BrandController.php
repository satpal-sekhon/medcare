<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(18);

        // Get the current and last page numbers
        $currentPage = $brands->currentPage();
        $lastPage = $brands->lastPage();
        
        // Redirect if the current page exceeds the last page
        if ($currentPage > $lastPage) {
            return redirect()->route('brands.index', ['page' => $lastPage]);
        }
        
        return view('frontend.brands', compact('brands'));
    }

    public function admin_brands_index(){
        return view('admin.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:brands',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $base_image_path = 'uploads/brands/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        Brand::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'image'];

        $query = Brand::query();

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
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('brands')->ignore($brand->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = $brand->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $base_image_path = 'uploads/brands/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        $brand->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $imagePath = $brand->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $brand->delete();

        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully.'
        ]);
    }
}

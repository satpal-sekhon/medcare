<?php

namespace App\Http\Controllers;

use App\Models\LabPackage;
use App\Models\LabTest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $labTests = LabTest::all();
        return view('admin.lab-packages.create', compact('labTests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'package_title' => 'required|string|max:100',
            'tests' => 'required|array',
            'tests.*' => 'integer|exists:lab_tests,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $base_image_path = 'uploads/lab-packages/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        $labPackage = LabPackage::create([
            'name' => $request->input('name'),
            'package_title' => $request->input('package_title'),
            'image' => $imagePath,
            'description' => $request->input('description')
        ]);

        $labPackage->labTests()->sync($request->input('tests'));

        return redirect()->route('admin.lab-packages.index')->with('success', 'Lab package added successfully!');
    }

    public function get(Request $request){
        $columns = ['id', 'name', 'image'];

        $query = LabPackage::query();

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
    public function show(LabPackage $labPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabPackage $labPackage)
    {
        $labTests = LabTest::all();
        return view('admin.lab-packages.edit', compact('labPackage', 'labTests'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabPackage $labPackage)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'package_title' => 'required|string|max:100',
            'tests' => 'required|array',
            'tests.*' => 'integer|exists:lab_tests,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $imagePath = $labPackage->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $base_image_path = 'uploads/lab-packages/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        $labPackage->update([
            'name' => $request->input('name'),
            'package_title' => $request->input('package_title'),
            'image' => $imagePath,
            'description' => $request->input('description')
        ]);

        $labPackage->labTests()->sync($request->input('tests'));

        return redirect()->route('admin.lab-packages.index')->with('success', 'Lab package updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabPackage $labPackage)
    {
        $imagePath = $labPackage->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $labPackage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lab package deleted successfully.'
        ]);
    }
}

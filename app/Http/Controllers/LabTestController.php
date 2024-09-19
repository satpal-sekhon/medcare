<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    public function admin_index(){
        return view('admin.lab-tests.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lab-tests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:lab_tests',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $base_image_path = 'uploads/lab-tests/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        LabTest::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.lab-tests.index')->with('success', 'Lab test saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'image'];

        $query = LabTest::query();

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
    public function show(LabTest $labTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabTest $labTest)
    {
        return view('admin.lab-tests.edit', compact('labTest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabTest $labTest)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('lab_tests')->ignore($labTest->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = $labTest->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $base_image_path = 'uploads/lab-tests/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        $labTest->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.lab-tests.index')->with('success', 'Lab test updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabTest $labTest)
    {
        $imagePath = $labTest->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $labTest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lab test deleted successfully.'
        ]);
    }
}

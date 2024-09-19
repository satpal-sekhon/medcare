<?php

namespace App\Http\Controllers;

use App\Models\DoctorType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index()
    {
        return view('admin.doctor-types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctor-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:75|unique:doctor_types',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $base_image_path = 'uploads/doctor-types/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        DoctorType::create([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin.doctor-types.index')->with('success', 'Doctor type added successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'image'];

        $query = DoctorType::query();

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
    public function show(DoctorType $doctorType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorType $doctorType)
    {
        return view('admin.doctor-types.edit', compact('doctorType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorType $doctorType)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('primary_categories')->ignore($doctorType->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            //'description' => 'required|string'
        ]);

        $imagePath = $doctorType->image;

        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            $base_image_path = 'uploads/doctor-types/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        $doctorType->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin.doctor-types.index')->with('success', 'Doctor type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorType $doctorType)
    {
        $imagePath = $doctorType->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $doctorType->delete();

        return response()->json([
            'success' => true,
            'message' => 'Doctor type deleted successfully.'
        ]);
    }
}

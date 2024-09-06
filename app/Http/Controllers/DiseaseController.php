<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_diseases_index()
    {
        return view('admin.diseases.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:diseases',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/diseases', 'public');
        }

        Disease::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $imagePath,
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.diseases.index')->with('success', 'Disease saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'image'];

        $query = Disease::query();

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
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disease $disease)
    {
        return view('admin.diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disease $disease)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('primary_categories')->ignore($disease->id)
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = $disease->image;

        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('images/diseases', 'public');
        }

        $disease->update([
            'name' => $request->input('name'),
            'image' => $imagePath,
            'description' => $request->input('description'),
            'show_on_homepage' => $request->input('show_on_homepage') ?? 0
        ]);

        return redirect()->route('admin.diseases.index')->with('success', 'Disease updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disease $disease)
    {
        $imagePath = $disease->image;

        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $disease->delete();

        return response()->json([
            'success' => true,
            'message' => 'Disease deleted successfully.'
        ]);
    }
}

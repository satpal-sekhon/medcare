<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('doctorType')->paginate(16);

        // Get the current and last page numbers
        $currentPage = $doctors->currentPage();
        $lastPage = $doctors->lastPage();
        
        // Redirect if the current page exceeds the last page
        if ($currentPage > $lastPage) {
            return redirect()->route('doctors.index', ['page' => $lastPage]);
        }

        $doctorTypes = DoctorType::select('id', 'name')->get();

        return view('frontend.doctors', compact('doctors', 'doctorTypes'));
    }

    public function admin_index()
    {
        return view('admin.doctors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctorTypes = DoctorType::all();
        return view('admin.doctors.create', compact('doctorTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_type' => 'required|string|max:100',
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:100|unique:doctors',
            'phone_number' => 'required|digits:10|unique:doctors',
            'qualification' => 'required|string|max:100',
            'experience' => 'nullable|numeric|regex:/^\d{1,2}(\.\d{1})?$/',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            //'description' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $base_image_path = 'uploads/doctors/';
            $filename = time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
                    
            $imagePath = $base_image_path.$filename;
        }

        Doctor::create([
            'doctor_type_id' => $request->input('doctor_type'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'qualification' => $request->input('qualification'),
            'experience' => $request->input('experience'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'name', 'email', 'phone_number', 'image', 'doctor_type'];

        $query = Doctor::query()
            ->select('doctors.id', 'doctors.name', 'doctors.email', 'doctors.phone_number', 'doctors.image')
            ->leftJoin('doctor_types', 'doctors.doctor_type_id', '=', 'doctor_types.id')
            ->addSelect('doctor_types.name as doctor_type');

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('doctors.name', 'like', "%{$search}%");
        }

        // Total records count before filtering
        $totalRecords = Doctor::count();

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

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $doctorTypes = DoctorType::all();
        return view('admin.doctors.edit', compact('doctor', 'doctorTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'doctor_type' => 'required|string|max:100',
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'string',
                'max:100',
                Rule::unique('doctors')->ignore($doctor->id),
            ],
            'phone_number' => [
                'required',
                'digits:10',
                Rule::unique('doctors')->ignore($doctor->id),
            ],
            'qualification' => 'required|string|max:100',
            'experience' => 'nullable|numeric|regex:/^\d{1,2}(\.\d{1})?$/',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'description' => 'nullable|string'
        ]);
    
        // Handle the image upload
        $imagePath = $doctor->image; 
        if ($request->hasFile('image')) {
            $base_image_path = 'uploads/doctors/';
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path($base_image_path), $filename);
    
            $imagePath = $base_image_path . $filename;
        }
    
        // Update the Doctor record
        $doctor->update([
            'doctor_type_id' => $request->input('doctor_type'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'qualification' => $request->input('qualification'),
            'experience' => $request->input('experience'),
            'image' => $imagePath,
            'description' => $request->input('description'),
        ]);
    
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $imagePath = $doctor->image;

        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $doctor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Doctor deleted successfully.'
        ]);
    }
}

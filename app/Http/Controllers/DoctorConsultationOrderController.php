<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\DoctorConsultationOrder;
use App\Models\DoctorType;
use Illuminate\Http\Request;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class DoctorConsultationOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index(){
        return view('admin.orders.doctor-consultations');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'email' => 'required|string|max:100',
            'phone_number' => 'required|digits:10',
            'doctor_id' => 'nullable|integer',
            'doctor_type' => 'required|string|max:100',
        ]);

        $doctorType = DoctorType::select('name')->find($request->input('doctor_type'))->name ?? '';
        $doctor = Doctor::select('name', 'qualification', 'fee', 'experience', 'image')->find($request->input('doctor_id'));

        try {
            DoctorConsultationOrder::create([
                'doctor_type_id' => $request->input('doctor_type'),
                'doctor_id' => $request->input('doctor_id'),
                'user_id' => $request->user()->id ?? null,
                'name' => $request->input('customer_name'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'doctor_type' => $doctorType,
                'doctor_name' => $doctor->name ?? '',
                'doctor_image' => $doctor->image ?? '',
                'doctor_qualification' => $doctor->qualification ?? '',
                'doctor_experience' => $doctor->experience ?? 0.0,
                'amount_paid' => $doctor->fee ?? 0.00,
            ]);
    
            
            // Attempt to send the password reset email
            $data = [
                'name' => $request->input('customer_name'),
                'doctor_type' => $doctorType,
                'doctor_name' => $doctor->name ?? 'N/A',
                'amount_paid' => $doctor->fee ?? 0.00,
            ];
            
            Mail::to($request->email)->send(new SendMail($data, 'emails.doctor-consultation-order-confirmation'));

            
            if($request->user()){
                return redirect()->route('my-account.orders')->with('success', 'Doctor consultation booked successfully!');
            }
    
            return redirect()->back()->with('success', 'Doctor consultation booked successfully!');
        } catch (\Exception $e) {    
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorConsultationOrder $doctorConsultationOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorConsultationOrder $doctorConsultationOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorConsultationOrder $doctorConsultationOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorConsultationOrder $doctorConsultationOrder)
    {
        //
    }
}

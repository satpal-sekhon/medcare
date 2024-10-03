<?php

namespace App\Http\Controllers;

use App\Mail\QuickOrderPlaced;
use App\Models\QuickOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuickOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index(){
        return view('admin.orders.quick-orders');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.quick-order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:50',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email|max:100',
            'prescription' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'instructions' => 'nullable|string',
        ]);

        $customer_email = $request->email;

        $prescriptionPath = null;
        $mimeType = null;
        if ($request->hasFile('prescription')) {
            $base_image_path = 'uploads/prescriptions/';
            $filename = time().'.'.$request->file('prescription')->getClientOriginalExtension();
            $mimeType = $request->file('prescription')->getMimeType();
            $request->file('prescription')->move(public_path($base_image_path), $filename);
                    
            $prescriptionPath = $base_image_path.$filename;
        }

        QuickOrder::create([
            'user_id' => $request->user()->id ?? null,
            'name' => $request->input('customer_name'),
            'phone_number' => $request->input('phone_number'),
            'email' => $customer_email,
            'prescription_path' => $prescriptionPath,
            'mime_type' => $mimeType,
            'status' => 'Pending',
            'instructions' => $request->input('instructions'),
        ]);

        
        $data = [
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'email' => $customer_email,
            'instructions' => $request->instructions ?? 'None',
        ];
        
        Mail::to($customer_email)->send(new QuickOrderPlaced($data));


        if($request->user()){
            return redirect()->route('my-account.orders')->with('success', 'Quick order placed successfully!');
        }

        return redirect()->back()->with('success', 'Quick order placed successfully!');
    }

    public function get(Request $request){
        $columns = ['id', 'name', 'email', 'phone_number'];

        $query = QuickOrder::with('user');

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('order_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                    $q->where('user_code', 'like', "%{$search}%");
                  });
            });
        }

        if($request->has('user_id')){
            $user_id = $request->user_id;
            $query->where(function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            });
        }
        
        $totalRecords = $query->count();
        $filteredRecords = $query->count();

        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        $data = $query->skip($request->start)->take($request->length)->get();

        $data = $data->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'order_number' => $order->order_number,
                'name' => $order->name,
                'email' => $order->email,
                'phone_number' => $order->phone_number,
                'prescription_path' => $order->prescription_path,
                'mime_type' => $order->mime_type,
                'status' => $order->status,
                'instructions' => $order->instructions,
                'user' => $order->user ? [
                    'id' => $order->user->id,
                    'user_code' => $order->user->user_code,
                ] : null,
            ];
        });

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    public function updateStatus(Request $request){
        $order = QuickOrder::find($request->id);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            "success" => true,
            "message" => 'Status Updated successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(QuickOrder $quickOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuickOrder $quickOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuickOrder $quickOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuickOrder $quickOrder)
    {
        $prescriptionPath = $quickOrder->prescription_path;

        if ($prescriptionPath && file_exists(public_path($prescriptionPath))) {
            unlink(public_path($prescriptionPath));
        }

        $quickOrder->delete();

        return response()->json([
            'success' => true,
            'message' => 'Quick order deleted successfully.'
        ]);
    }
}

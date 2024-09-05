<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function admin_index(){
        return view('admin.coupons.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'discount_amount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:amount,percentage',
            'start_date' => 'nullable|date|after_or_equal:today',
            'expires_at' => 'nullable|date|after:start_date',
            'is_active' => 'nullable|boolean',
        ]);

        Coupon::create([
            'code' => $request->input('code'),
            'discount_amount' => $request->input('discount_amount'),
            'discount_type' => $request->input('discount_type'),
            'start_date' => $request->input('start_date'),
            'expires_at' => $request->input('expires_at'),
            'is_active' => $request->input('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon saved successfully!');
    }

    public function get(Request $request)
    {
        $columns = ['code', 'discount_amount', 'discount_type', 'start_date', 'expires_at', 'is_active'];

        $query = Coupon::query();

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('code', 'like', "%{$search}%");
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
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => [
                'required', 'string', 'max:50',
                Rule::unique('coupons')->ignore($coupon->id)
            ],
            'discount_amount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:amount,percentage',
            'start_date' => 'nullable|date|after_or_equal:today',
            'expires_at' => 'nullable|date|after:start_date',
            'is_active' => 'nullable|boolean',
        ]);

        $coupon->update([
            'code' => $request->input('code'),
            'discount_amount' => $request->input('discount_amount'),
            'discount_type' => $request->input('discount_type'),
            'start_date' => $request->input('start_date'),
            'expires_at' => $request->input('expires_at'),
            'is_active' => $request->input('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return response()->json([
            'success' => true,
            'message' => 'Coupon deleted successfully.'
        ]);
    }
}

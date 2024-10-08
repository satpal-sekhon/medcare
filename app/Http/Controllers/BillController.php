<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function adminIndex(){
        if(isVendor()){
            return view('vendor.bills.index');
        }

        return view('admin.bills.index');
    }

    public function get(Request $request)
    {
        $columns = ['id', 'bill_from', 'bill_from_address', 'bill_from_contact', 'bill_to_name', 'bill_to_address', 'bill_to_contact'];

        $query = Bill::query();

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('bill_to_name', 'like', "%{$search}%");
        }

        if ($request->has('user_id') && $request->user_id) {
            $user_id = $request->user_id;
            $query->where('billed_by', $user_id);
        }

        // Total records count before filtering
        $totalRecords = Bill::count();

        // Filtered records count after applying search
        $filteredRecords = $query->count();

        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        $data = $query->withCount('products')->withSum('products', 'total')->skip($request->start)->take($request->length)->get();

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = User::where('id', '!=', Auth::id())->latest()->get();
        $products = Product::latest()->get();

        if(isVendor()){
            return view('vendor.bills.create', compact('customers', 'products'));
        }

        return view('admin.bills.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $customerId = null;
        $customerName = $request->custom_name;

        if (isset($request->customer)) {
            $user = User::find($request->customer);
            
            if ($user) {
                $customerId = $user->id;
                $customerName = $user->name;
            }
        }
        
        $bill = Bill::create([
            'billed_by' => Auth::id(), 
            'bill_from' => $request->bill_from, 
            'bill_from_address' => $request->bill_from_address, 
            'bill_from_contact' => $request->bill_from_contact, 
            'bill_to' => $customerId, 
            'bill_to_name' => $customerName, 
            'bill_to_address' => $request->bill_to_address, 
            'bill_to_contact' => $request->bill_to_contact, 
        ]);
        
        $products = json_decode($request->addedProducts);
        foreach($products as $product){
            BillProduct::create([
                'bill_id' => $bill->id,
                'product_name' => $product->product,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'total' => $product->total,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Bill generated successfully!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        return view('admin.bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bill deleted successfully!'
        ]);
    }
}

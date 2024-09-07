<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        $states = State::select('name')->get();
        return view('frontend.my-account.addresses.index', compact('addresses', 'states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::all(); 
        return view('frontend.my-account.addresses.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:25',
            'phone_number'  => 'required|digits:10',
            'address_line_1'=> [
                'required',
                'string',
                'max:150',
                Rule::unique('addresses')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                }),
            ],
            'address_line2' => 'nullable|string|max:150',
            'city'          => 'required|string|max:75',
            'state'         => 'required|string|max:75',
            'pincode'       => 'required|digits:6',
            'address_type'  => 'required|string|max:25',
            'company_name'  => [
                'nullable',
                'string',
                'max:75',
                'required_if:address_type,Office',
            ],
            'instructions' => 'nullable|string|max:255',
        ]);

        $user_id = Auth::id();

        $hasAddresses = Address::where('user_id', $user_id)->exists();

        $is_default = $request->input('is_default', false);

        if(!$hasAddresses){
            $is_default = true;
        } else {
            if ($is_default) {
                Address::where('user_id', $user_id)->update(['is_default' => false]);
            }
        }

        Address::create([
            'user_id' => $user_id,
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
            'address_type' => $request->input('address_type'),
            'company_name' => $request->input('company_name'),
            'instructions' => $request->input('instructionss'),
            'is_default' => $is_default ?? 0
        ]);

        return redirect()->route('addresses.index')->with('success', 'Address saved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        $states = State::select('name')->get();
        return view('frontend.my-account.addresses.edit', compact('address', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'name'          => 'required|string|max:25',
            'phone_number'  => 'required|digits:10',
            'address_line_1'=> [
                'required',
                'string',
                'max:150',
                Rule::unique('addresses')->ignore($address->id)->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id);
                }),
            ],
            'address_line_2' => 'nullable|string|max:150',
            'city'          => 'required|string|max:75',
            'state'         => 'required|string|max:75',
            'pincode'       => 'required|digits:6',
            'address_type'  => 'required|string|max:25',
            'company_name'  => [
                'nullable',
                'string',
                'max:75',
                'required_if:address_type,Office',
            ],
            'instructions' => 'nullable|string|max:255',
            'is_default'   => 'nullable|boolean',
        ]);
    
        // Check if the address belongs to the authenticated user
        if ($address->user_id !== $request->user()->id) {
            return redirect()->route('addresses.index')->with('error', 'You are not authorized to update the address');
        }
    
        // Retrieve the input values
        $is_default = $request->input('is_default', false);
    
        // If this address is being set as default, update other addresses to no longer be default
        if ($is_default) {
            Address::where('user_id', $address->user_id)->update(['is_default' => false]);
        }
    
        // Update the address
        $address->update([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'pincode' => $request->input('pincode'),
            'address_type' => $request->input('address_type'),
            'company_name' => $request->input('company_name'),
            'instructions' => $request->input('instructions'),
            'is_default' => $is_default
        ]);
    
        return redirect()->route('addresses.index')->with('success', 'Address updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        // Check if the address belongs to the authenticated user
        if ($address->user_id !== Auth::id()) {
            return redirect()->route('addresses.index')->with('error', 'You are not authorized to delete this address');
        }

        // If the address to be deleted is the default address, update another address to be the default
        if ($address->is_default) {
            // Find another address to set as default
            $newDefaultAddress = Address::where('user_id', $address->user_id)
                ->where('id', '<>', $address->id)
                ->first();

            // Set the new default address if it exists
            if ($newDefaultAddress) {
                $newDefaultAddress->update(['is_default' => true]);
            }
        }

        // Delete the address
        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully!');
    }
}

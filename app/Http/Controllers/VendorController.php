<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorAsset;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function new_vendors_index(){
        return view('admin.vendors.new-vendors');
    }

    public function admin_index(){
        return view('admin.vendors.index');
    }

    public function pending_approval_index(){
        return view('admin.vendors.pending-approval-vendors');
    }

    public function suspended_admin_index(){
        return view('admin.vendors.suspended-vendors');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        $states = State::select('name')->get();
        $vendor->load('user', 'assets');

        return view('admin.vendors.edit', compact('vendor', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'user_name'             => 'required|string|max:50',
            'email'                 => [
                                        'required',
                                        'email',
                                        'max:100',
                                        Rule::unique('users')->ignore($vendor->user->id),
                                    ],
            'phone_number'          => [
                                        'required',
                                        'digits:10',
                                        Rule::unique('users')->ignore($vendor->user->id),
                                    ],
            'address'               => 'required|string|max:255',
            'city'                  => 'required|string|max:50',
            'pincode'               => 'required|digits:6',
            'state'                 => 'required|string|max:50',

            'business_name'         => 'required|string|max:75',
            'business_email'        => [
                                        'required',
                                        'email',
                                        'max:100',
                                        Rule::unique('vendors', 'email')->ignore($vendor->id),
                                    ],
            'business_phone_number' => [
                                        'required',
                                        'digits:10',
                                        Rule::unique('vendors', 'phone_number')->ignore($vendor->id),
                                    ],
            'business_address'      => 'required|string|max:255',
            'business_city'         => 'required|string|max:50',
            'business_pincode'      => 'required|digits:6',
            'business_state'        => 'required|string|max:50',
            'license_number'        => 'required|string',
            'store_image'           => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'documents.*'           => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $vendor->user()->update([
            'name'          => $request->input('user_name'),
            'email'         => $request->input('email'),
            'phone_number'  => preg_replace('/\D/', '', $request->input('phone_number')),
            'address'       => $request->input('address'),
            'city'          => $request->input('city'),
            'pincode'       => $request->input('pincode'),
            'state'         => $request->input('state'),
            'status'        => $request->input('status')
        ]);

        $storeImagePath = $vendor->image;
        if ($request->hasFile('store_image')) {
            $storeImage = $request->file('store_image');
            $storeImagePath = uploadFile($storeImage, 'uploads/stores/');
        }

        $vendor->update([
            'name'              => $request->input('business_name'),
            'email'             => $request->input('business_email'),
            'phone_number'      => preg_replace('/\D/', '', $request->input('business_phone_number')),
            'address'           => $request->input('business_address'),
            'city'              => $request->input('business_city'),
            'state'             => $request->input('business_state'),
            'image'             => $storeImagePath,
            'pincode'           => $request->input('business_pincode'),
            'type'              => $request->input('business_type'),
            'shop_type'         => $request->input('shop_type'),
            'license_number'    => $request->input('license_number'),
        ]);

        // Handle deletion of selected assets
        if ($request->has('delete_documents')) {
            $idsToDelete = $request->input('delete_documents');

            VendorAsset::whereIn('id', $idsToDelete)->each(function ($asset) {
                $documentPath = $asset->path;

                if ($documentPath && file_exists(public_path($documentPath))) {
                    unlink(public_path($documentPath));
                }

                $asset->delete();
            });
        }
            

        // Handle the documents
        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');
            foreach ($documents as $document) {
                $mimeType = $document->getMimeType();
                $documentPath = uploadFile($document, 'uploads/vendor-documents/');
                $vendor->assets()->create([
                    'path' => $documentPath,
                    'mime_type' => $mimeType,
                ]);
            }
        }
        
        $successMessage = 'Vendor record has been successfully updated';

        if($request->input('status') == 'Pending Approval'){
            return redirect()->route('admin.vendors.pending-approvals')->with('success', $successMessage);
        } else if($request->input('status') == 'Suspended'){
            return redirect()->route('admin.vendors.suspended')->with('success', $successMessage);
        } else {
            return redirect()->route('admin.vendors.index')->with('success', $successMessage);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}

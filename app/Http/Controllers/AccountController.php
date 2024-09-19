<?php

namespace App\Http\Controllers;

use App\Models\DoctorConsultationOrder;
use App\Models\LabPackageOrder;
use App\Models\Order;
use App\Models\QuickOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function user_account()
    {
        $totalOrders = 0;
        $totalOrders += Order::where('user_id', Auth::id())->count();
        $totalOrders += QuickOrder::where('user_id', Auth::id())->count();
        $totalOrders += LabPackageOrder::where('user_id', Auth::id())->count();
        $totalOrders += DoctorConsultationOrder::where('user_id', Auth::id())->count();

        return view('frontend.my-account.dashboard', compact('totalOrders'));
    }

    public function wishlist()
    {
        return view('frontend.my-account.wishlist');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        $quickOrders = QuickOrder::where('user_id', Auth::id())->latest()->get();
        $labPackageOrders = LabPackageOrder::where('user_id', Auth::id())->latest()->get();
        $doctorConsultationOrders = DoctorConsultationOrder::where('user_id', Auth::id())->latest()->get();

        return view('frontend.my-account.orders', compact('orders', 'quickOrders', 'labPackageOrders', 'doctorConsultationOrders'));
    }

    public function profile()
    {
        return view('frontend.my-account.profile');
    }

    /* Vendor Module */
    public function submit_vendor_docs_for_verification(Request $request)
    {
        // Validate the request
        $request->validate([
            'store_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Initialize paths
        $storeImagePath = null;

        // Handle the store image
        if ($request->hasFile('store_image')) {
            $storeImage = $request->file('store_image');
            $storeImagePath = uploadFile($storeImage, 'uploads/stores/');
        }

        // Update vendor's image
        $vendorUser = $request->user()->vendor;
        if ($storeImagePath) {
            $vendorUser->update(['image' => $storeImagePath]);
        }

        // Handle the documents
        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');
            foreach ($documents as $document) {
                $mimeType = $document->getMimeType();
                $documentPath = uploadFile($document, 'uploads/vendor-documents/');
                $vendorUser->assets()->create([
                    'path' => $documentPath,
                    'mime_type' => $mimeType,
                ]);
            }
        }

        return back()->with('success', 'Your application has been successfully submitted for verification.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DoctorConsultationOrder;
use App\Models\LabPackageOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\QuickOrder;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $productIds = session()->get('wishlist', []);
        $products = Product::select('id', 'primary_category_id', 'category_id', 'brand_id', 'name', 'slug', 'unit', 'thumbnail', 'flag', 'customer_price', 'mrp')->whereIn('id', $productIds)->get();
        return view('frontend.my-account.wishlist', compact('products'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        $quickOrders = QuickOrder::where('user_id', Auth::id())->latest()->get();
        $labPackageOrders = LabPackageOrder::where('user_id', Auth::id())->latest()->get();
        $doctorConsultationOrders = DoctorConsultationOrder::where('user_id', Auth::id())->latest()->get();

        return view('frontend.my-account.orders', compact('orders', 'quickOrders', 'labPackageOrders', 'doctorConsultationOrders'));
    }

    public function notifications(){
        $user = Auth::user();
        $notifications = $user->notifications;
        $user->unreadNotifications->markAsRead();
        
        return view('frontend.my-account.notifications', compact('notifications'));
    }

    public function profile()
    {
        return view('frontend.my-account.profile');
    }

    /* Vendor Module */
    public function resubmitDocs(){
        return view('vendor.resubmit-docs');
    }

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

    public function vendorProfile(){
        $states = State::all(); 
        return view('vendor.my-profile', compact('states'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'user_name'             => 'required|string|max:50',
            'email'                 => 'required|email|max:100|unique:users,email,'.Auth::id(),
            'phone_number'          => 'required|digits:10|unique:users,phone_number,'.Auth::id(),
            'address'               => 'required|string|max:255',
            'city'                  => 'required|string|max:50',
            'pincode'               => 'required|digits:6',
            'state'                 => 'required|string|max:50',
            'new_password'          => [
                'nullable',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[!@#$%^&*()_+\-=\[\]{};":\\|,.<>\/?~`]/', // must contain a special character
            ],
            'confirm_password'      => 'nullable|string|min:8|same:new_password',
        ]);

        if($request->confirm_password != $request->new_password){
            return back()->withInput()->withErrors([
                'confirm_password' => 'Passwords are not matching!',
            ]);
        }

        $user = User::find(Auth::id());
        $user->name = $request->user_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->pincode = $request->pincode;
        $user->state = $request->state;

        if($request->new_password){
            $user->state = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Your profile has been updated!');
    }
}

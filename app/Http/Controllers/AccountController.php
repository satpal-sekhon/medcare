<?php

namespace App\Http\Controllers;

use App\Models\DoctorConsultationOrder;
use App\Models\LabPackageOrder;
use App\Models\QuickOrder;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function user_account(){
        $totalOrders = 0;
        $totalOrders += QuickOrder::where('user_id', Auth::id())->latest()->count();
        $totalOrders += LabPackageOrder::where('user_id', Auth::id())->latest()->count();
        $totalOrders = DoctorConsultationOrder::where('user_id', Auth::id())->latest()->count();

        return view('frontend.my-account.dashboard', compact('totalOrders'));
    }

    public function wishlist(){
        return view('frontend.my-account.wishlist');
    }

    public function orders(){
        $quickOrders = QuickOrder::where('user_id', Auth::id())->latest()->get();
        $labPackageOrders = LabPackageOrder::where('user_id', Auth::id())->latest()->get();
        $doctorConsultationOrders = DoctorConsultationOrder::where('user_id', Auth::id())->latest()->get();

        return view('frontend.my-account.orders', compact('quickOrders', 'labPackageOrders', 'doctorConsultationOrders'));
    }

    public function profile(){
        return view('frontend.my-account.profile');
    }
}

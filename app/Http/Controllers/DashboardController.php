<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('frontend.home');
    }

    public function admin_dashboard(){
        return view('admin.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function faq(){
        return view('frontend.faq');
    }

    public function about(){
        return view('frontend.about');
    }
}

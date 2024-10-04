<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function faq(){
        $faqs = FAQ::latest()->get();
        return view('frontend.faq', compact('faqs'));
    }

    public function about(){
        return view('frontend.about');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Disease;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $diseases = Disease::select('id', 'name', 'image')->where('show_on_homepage', true)->limit(10)->get();
        $categories = Category::select('id', 'name', 'image')->where('show_on_homepage', true)->limit(16)->get();
        $brands = Brand::select('id', 'name', 'image')->where('show_on_homepage', true)->limit(16)->get();
        $homepageProducts = Product::where('show_on_homepage', true)->limit(8)->get();
        
        return view('frontend.home', compact('diseases', 'categories', 'brands', 'homepageProducts'));
    }

    public function admin_dashboard(){
        return view('admin.dashboard');
    }
}

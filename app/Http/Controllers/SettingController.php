<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function admin_general_settings(){
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.general-settings', compact('settings'));
    }

    public function admin_general_settings_update(Request $request){
        $request->validate([
            'primary_category_image' => 'nullable|image|max:2048',
            'category_image' => 'nullable|image|max:2048',
            'brand_image' => 'nullable|image|max:2048',
            'disease_image' => 'nullable|image|max:2048',
            'product_image' => 'nullable|image|max:2048',
            'doctor_image' => 'nullable|image|max:2048',
            'lab_package_image' => 'nullable|image|max:2048',
        ]);

        foreach ($request->all() as $key => $image) {
            if ($key === '_token' || !$request->hasFile($key)) {
                continue;
            }

            $currentImagePath = Setting::where('key', $key)->pluck('value')->first();
            // Delete the old file if it exists
            if ($currentImagePath && file_exists(public_path($currentImagePath))) {
                unlink(public_path($currentImagePath));
            }

            // Handle the file upload
            $imagePath = uploadFile($image, 'uploads/default-images/');

            // Update or create the setting
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $imagePath]
            );
        }

        return redirect()->route('admin.settings.general')->with('success', 'Settings updated successfully.');
    }

    public function menuSettings(){
        $menuItems = MenuItem::with('children')->whereNull('parent_id')->get();
        return view('admin.settings.menu-settings', compact('menuItems'));
    }

    public function updateMenuSettings(Request $request){
        $request->validate([
            'label.*' => 'required|string|max:255'
        ]);

        
        foreach($request->label as $id => $label){
            $menuItem = MenuItem::findOrFail($id);
            $menuItem->label = $label;
            
            $meta_tags = [];
            if(isset($request->meta_name[$id])){
                $meta_tags['meta_name'] = $request->meta_name[$id];
            }

            if(isset($request->meta_description[$id])){
                $meta_tags['meta_description'] = $request->meta_description[$id];
            }

            if(isset($request->meta_keywords[$id])){
                $meta_tags['meta_keywords'] = $request->meta_keywords[$id];
            }
            
            $menuItem->meta_tags = $meta_tags;
            $menuItem->save();
        }

        return redirect()->route('admin.settings.menu')->with('success', 'Menu updated successfully.');
    }
}

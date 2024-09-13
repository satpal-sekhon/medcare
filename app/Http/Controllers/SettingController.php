<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
}

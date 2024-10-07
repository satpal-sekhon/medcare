<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use App\Models\MenuItem;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function admin_general_settings()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.general-settings', compact('settings'));
    }

    public function admin_general_settings_update(Request $request)
    {
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

    public function menuSettings()
    {
        $menuItems = MenuItem::with('children')->whereNull('parent_id')->get();
        return view('admin.settings.menu-settings', compact('menuItems'));
    }

    public function updateMenuSettings(Request $request)
    {
        $request->validate([
            'label.*' => 'required|string|max:255',
            'meta_name.*' => 'nullable|string|max:255',
            'meta_description.*' => 'nullable|string|max:500',
            'meta_keywords.*' => 'nullable|string|max:255',
        ]);

        foreach ($request->label as $id => $label) {
            $menuItem = MenuItem::findOrFail($id);
            $menuItem->label = $label;

            $meta_tags['meta_name'] = $request->meta_name[$id] ?? '';
            $meta_tags['meta_description'] = $request->meta_description[$id] ?? '';
            $meta_tags['meta_keywords'] = $request->meta_keywords[$id] ?? '';

            $menuItem->meta_tags = $meta_tags;
            $menuItem->save();
        }

        return redirect()->route('admin.settings.menu')->with('success', 'Menu updated successfully.');
    }

    public function siteSettings()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.site-settings', compact('settings'));
    }

    public function saveSiteSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo_1' => 'nullable|image|max:2048',
            'site_logo_2' => 'nullable|image|max:2048',
            'site_contact_number' => 'required|digits:10',
            'site_contact_email' => 'required|email|max:255',
            'site_address' => 'required|string|max:255',
        ]);

        $settings = [
            'site_name' => $request->site_name,
            'site_contact_number' => $request->site_contact_number,
            'site_contact_email' => $request->site_contact_email,
            'site_address' => $request->site_address,
        ];
    
        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        
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

        return redirect()->route('admin.settings.site')->with('success', 'Site settings updated successfully.');
    }

    public function homePageSettings()
    {
        $settings = HomePage::find(1);
        return view('admin.settings.home-page', compact('settings'));
    }

    public function saveHomePageSettings(Request $request)
    {
        $request->validate([
            'top_header_text.*' => 'required|string|max:255'
        ]);

        $settings = HomePage::find(1);
        $settings->top_header_text = json_encode($request->top_header_text);

        $metaSettings = [
            'home_meta_title' => [
                'value' => $request->meta_title,
            ],
            'home_meta_keywords' => [
                'value' => $request->meta_keywords,
            ],
            'home_meta_description' => [
                'value' => $request->meta_description,
            ],
        ];

        foreach ($metaSettings as $key => $setting) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $setting['value']]
            );
        }


        foreach (['home_main_banner', 'home_offer', 'home_horizontal'] as $prefix) {
            for ($i = 1; $i <= 4; $i++) {
                // Check if a new file was uploaded
                if ($request->hasFile("{$prefix}_image_{$i}")) {
                    // Upload new file and store the path
                    $file = $request->file("{$prefix}_image_{$i}");
                    $path = uploadFile($file, "uploads/home-page/{$prefix}/");
                    $settings->{"{$prefix}_image_{$i}"} = $path;
                }

                // Update the link regardless of whether a new image was uploaded
                if ($request->has("{$prefix}_image_{$i}_link")) {
                    $settings->{"{$prefix}_image_{$i}_link"} = $request->input("{$prefix}_image_{$i}_link");
                }
            }
        }

        $settings->save();

        return response()->json(['message' => 'Settings updated successfully!']);
    }

    public function paymentSettings()
    {
        return view('admin.settings.payment-settings');
    }

    public function paymentSettingsUpdate(Request $request)
    {
        $request->validate([
            'cod_charges' => 'required|numeric|between:0,999999.99',
            'vendor_cod_charges' => 'required|numeric|between:0,999999.99',
            'razorpay_key_id' => 'required|string|max:255',
            'razorpay_key_secret' => 'required|string|max:255',
            'razorpay_environment' => 'required|string|max:255',
            'paytm_merchant_id' => 'required|string|max:255',
            'paytm_merchant_key' => 'required|string|max:255',
            'paytm_channel_id' => 'required|string|max:255',
            'paytm_industry_type' => 'required|string|max:255',
            'paytm_website' => 'required|string|max:255',
            'paytm_environment' => 'required|string|max:255',
        ]);

        $paymentSettings = [
            'cod_charges' => [
                'value' => number_format($request->cod_charges, 2, '.', ''),
            ],
            'vendor_cod_charges' => [
                'value' => number_format($request->vendor_cod_charges, 2, '.', ''),
            ],
            'razorpay_key_id' => [
                'value' => $request->razorpay_key_id,
            ],
            'razorpay_key_secret' => [
                'value' => $request->razorpay_key_secret,
            ],
            'razorpay_environment' => [
                'value' => $request->razorpay_environment,
            ],
            'razorpay_for_vendor' => [
                'value' => $request->razorpay_for_vendor,
            ],
            'razorpay_for_customer' => [
                'value' => $request->razorpay_for_customer,
            ],
            'paytm_merchant_id' => [
                'value' => $request->paytm_merchant_id,
            ],
            'paytm_merchant_key' => [
                'value' => $request->paytm_merchant_key,
            ],
            'paytm_channel_id' => [
                'value' => $request->paytm_channel_id,
            ],
            'paytm_industry_type' => [
                'value' => $request->paytm_industry_type,
            ],
            'paytm_website' => [
                'value' => $request->paytm_website,
            ],
            'paytm_environment' => [
                'value' => $request->paytm_environment,
            ]
        ];

        foreach ($paymentSettings as $key => $setting) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $setting['value']]
            );
        }

        return redirect()->route('admin.settings.payment')->with('success', 'Payment settings updated successfully.');
    }
}

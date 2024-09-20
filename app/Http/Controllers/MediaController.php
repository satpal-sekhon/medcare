<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Disease;
use App\Models\Doctor;
use App\Models\LabPackage;
use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Vendor;
use App\Models\VendorAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function index()
    {
        return view('admin.media.index');
    }


    public function get(Request $request)
    {
        // Path to the uploads directory
        $path = public_path('uploads');
        $defaultPerPage = 10;

        // Get all image files from the directory and subdirectories, excluding 'default'
        $images = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {
            // Exclude the 'default' directory
            if (
                strpos($file->getRelativePath(), 'default') === false &&
                in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'])
            ) {

                $relativePath = $file->getRelativePathname();
                $folderPath = dirname($relativePath);

                $images[] = [
                    'path' => asset('uploads/' . $file->getRelativePathname()),
                    'folder' => $folderPath,
                    'time' => $file->getMTime(),
                ];
            }
        }

        // Sort images by modification time in descending order
        usort($images, function ($a, $b) {
            return $b['time'] <=> $a['time'];
        });

        $perPage = $request->input('per_page', $defaultPerPage);
        $currentPage = $request->get('page', 1);
        $totalImages = count($images);
        $images = array_slice($images, ($currentPage - 1) * $perPage, $perPage);

        // Create a simple pagination structure
        $pagination = [
            'total' => $totalImages,
            'current_page' => $currentPage,
            'last_page' => ceil($totalImages / $perPage),
            'per_page' => $perPage,
        ];


        return response()->json([
            'success' => true,
            'images' => $images,
            'meta' => $pagination
        ]);
    }

    protected $folderToModelMap = [
        'product-thumbnails' => [Product::class, 'thumbnail'],
        'products' => [ProductImage::class, 'path'],
        'primary-categories' => [PrimaryCategory::class, 'image'],
        'banners/primary-categories' => [PrimaryCategory::class, 'banner_image'],
        'lab-packages' => [LabPackage::class, 'image'],
        'banners/lab-packages' => [LabPackage::class, 'banner_image'],
        'doctors' => [Doctor::class, 'image'],
        'banners/doctors' => [Doctor::class, 'banner_image'],
        'diseases' => [Disease::class, 'image'],
        'banners/diseases' => [Disease::class, 'banner_image'],
        'categories' => [Category::class, 'image'],
        'banners/categories' => [Category::class, 'banner_image'],
        'brands' => [Brand::class, 'image'],
        'banners/brands' => [Brand::class, 'banner_image'],
        'stores' => [Vendor::class, 'image'],
        'vendor-documents' => [VendorAsset::class, 'path'],
    ];

    public function deleteImages(Request $request)
    {
        $deletedImages = [];
        $notFoundImages = [];

        foreach ($request->images as $image) {
            $urlPath = $image['url'];
            $parsedUrl = parse_url($urlPath);
            $relativePath = str_replace('\\', '/', $parsedUrl['path']);

            $savedPath = preg_replace('/^\/uploads\//', 'uploads/', $relativePath);
            $folder = str_replace('\\', '/', $image['folder']);

            if (isset($this->folderToModelMap[$folder])) {
                [$modelClass, $columnName] = $this->folderToModelMap[$folder];
                $modelInstance = $modelClass::where($columnName, $savedPath)->first();

                if ($modelInstance) {
                    if ($modelClass === ProductImage::class || $modelClass === VendorAsset::class) {
                        $modelInstance->delete();
                    } else {
                        $modelInstance->$columnName = null;
                        $modelInstance->save();
                    }
                }
            }

            $fullPath = public_path($savedPath);
            
            if (File::exists($fullPath)) {
                File::delete($fullPath);
                $deletedImages[] = $image['url'];
            } else {
                $notFoundImages[] = $image['url'];
            }
        }

        return response()->json([
            'success' => true,
            'deleted' => $deletedImages,
            'not_found' => $notFoundImages,
        ]);
    }
}

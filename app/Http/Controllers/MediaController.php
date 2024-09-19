<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function index(){
        return view('admin.media.index');
    }


    public function get(Request $request){
        // Path to the uploads directory
        $path = public_path('uploads');
        $defaultPerPage = 10;

        // Get all image files from the directory and subdirectories, excluding 'default'
        $images = [];
        $files = File::allFiles($path);

        foreach ($files as $file) {            
            // Exclude the 'default' directory
            if (strpos($file->getRelativePath(), 'default') === false &&
                in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'])) {
                $images[] = [
                    'path' => asset('uploads/' . $file->getRelativePathname()),
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
}

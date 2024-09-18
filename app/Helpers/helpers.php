<?php

if (!function_exists('getFileTypeByMimeType')) {
    /**
     * Gets the general file type based on MIME type.
     *
     * @param string $mimeType The MIME type to categorize.
     * @return string The general file type, such as 'image', 'document', or 'audio'.
     */
    function getFileTypeByMimeType($mimeType)
    {
        // Define a mapping of MIME types to general file types
        $mimeTypeToFileType = [
            'image/jpeg' => 'image',
            'image/png' => 'image',
            'image/gif' => 'image',
            'text/plain' => 'text',
            'text/html' => 'text',
            'application/pdf' => 'document',
            'application/zip' => 'archive',
            'application/vnd.ms-excel' => 'spreadsheet',
            'application/msword' => 'document',
            'application/json' => 'data',
            'audio/mpeg' => 'audio',
            'video/mp4' => 'video',
            'application/xml' => 'data',
        ];

        // Return the general file type or 'unknown' if the MIME type is not in the array
        return $mimeTypeToFileType[$mimeType] ?? 'unknown';
    }
}


/**
 * Retrieves a disease by its ID.
 *
 * @param int $diseaseId The ID of the disease to retrieve.
 * @return \App\Models\Disease|null The disease model instance or null if not found.
 */
function diseaseName($diseaseId)
{
    return \App\Models\Disease::find($diseaseId)->name ?? '';
}


function diseaseSlug($diseaseId)
{
    return \App\Models\Disease::find($diseaseId)->slug ?? '';
}


/**
 * Retrieves the value of a setting by its key.
 *
 * @param string $key The key of the setting to retrieve.
 * @return string|null The value of the setting or null if not found.
 */
function getSetting($key)
{
    // Retrieve the setting model instance by key
    $setting = \App\Models\Setting::where('key', $key)->first();

    // Return the value if the setting is found, otherwise return null
    return $setting->value ?? null;
}


/**
 * Handle file uploads and return the file path.
 *
 * @param \Illuminate\Http\UploadedFile $file
 * @param string $directory
 * @return string
 */
function uploadFile($file, $directory)
{
    if(!$file){
        return null;
    }

    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path($directory), $filename);
    return $directory . $filename;
}

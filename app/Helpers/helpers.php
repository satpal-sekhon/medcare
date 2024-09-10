<?php

if (!function_exists('getFileTypeByMimeType')) {
    /**
     * Gets the general file type based on MIME type.
     *
     * @param string $mimeType The MIME type to categorize.
     * @return string The general file type, such as 'image', 'document', or 'audio'.
     */
    function getFileTypeByMimeType($mimeType) {
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

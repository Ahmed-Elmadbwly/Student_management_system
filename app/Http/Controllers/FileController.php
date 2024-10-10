<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function downloadFile($filename)
    {
        $file = Storage::path('public/documents/' . $filename);
        if (!file_exists($file)) {
            abort(404);
        }
        return response()->download($file);
    }

    public function showFile($filename)
    {
        $path = storage_path('app/public/documents/' . $filename);
//        dd($path);
        // Check if the file exists
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        // Prepare the response with the appropriate headers to display the PDF inline
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function downloadFile($filename)
    {
        $filePath = storage_path('app/uploads/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        return abort(404, 'File not found');
    }

    public function showFile($filename)
    {
        $filePath = storage_path('app/uploads/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        }

        return abort(404, 'File not found');
    }
}

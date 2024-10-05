<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $file = Storage::url('documents/' . $filename);
        return view('showFile', compact('file'));
    }
}

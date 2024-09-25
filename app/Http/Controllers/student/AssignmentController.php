<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AnswerAssignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create(Request $request)
    {
        $val = $request->validate(['answerFile'=>'required']);
        $file = $request->file('answerFile');
        $filePath = $file->store('videos');
        $fileName = basename($filePath);
        AnswerAssignment::create([
            'userId'=>auth()->id(),
            'assignmentId'=>$request->id,
            'answerFile'=>$fileName,
        ]);
        return redirect()->back();
    }
}

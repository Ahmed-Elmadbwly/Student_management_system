<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\AnswerAssignment;
use App\Models\assignment;
use App\Services\AssignmentServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public $AssignmentServices;
    public function __construct(AssignmentServices $AssignmentServices){
        $this->AssignmentServices = $AssignmentServices;
    }
    public function create(Request $request)
    {
        $this->AssignmentServices->createAssignment($request);
        return redirect()->back();
    }
    public function delete($id)
    {
        $this->AssignmentServices->deleteAssignment($id);
        return redirect()->back();
    }
    public function answers($id)
    {
        return view('teacher.assignment.answers',['assignmentId'=>$id,'answers'=>$this->AssignmentServices->getAnswerAssignment($id)]);
    }
    public function allAssignment()
    {
        return view('teacher.assignment.index',['assignments'=>$this->AssignmentServices->getAssignment()]);
    }
    public function review($answerId,$id)
    {
        return view('teacher.assignment.review',['answerId'=>$answerId,'answer'=>$this->AssignmentServices->getAnswerAssignmentById($id)]);
    }
    public function addScore(Request $request,$answerId,$id)
    {
        $this->AssignmentServices->updateAnswer($request,$id);
        return to_route('teacher.assignments.answers',$answerId);
    }
}

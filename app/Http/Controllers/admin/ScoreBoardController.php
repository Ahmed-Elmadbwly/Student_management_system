<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\ScoreBoardServices;
use Illuminate\Http\Request;

class ScoreBoardController extends Controller
{
    public $ScoreBoardServices;
    public function __construct(ScoreBoardServices $ScoreBoardServices){
        $this->ScoreBoardServices = $ScoreBoardServices;
    }
    public function index()
    {
       return view('teacher.scoreBoard.index',['type'=>'test','subLessons'=> $this->ScoreBoardServices->getTests()]);
    }
    public function scoreStudent($id){
        return view('teacher.scoreBoard.show',['students'=> $this->ScoreBoardServices->getScoreStudents($id)]);
    }
    public function showAssignment()
    {
        return view('teacher.scoreBoard.index',['type'=>'assignment','subLessons'=> $this->ScoreBoardServices->getAssignment()]);
    }
    public function assignmentScore($id)
    {
        return view('teacher.scoreBoard.show',['students'=> $this->ScoreBoardServices->AssignmentScore($id)]);
    }
    public function allTests()
    {
        return view('teacher.scoreBoard.index',['type'=>'test','subLessons'=> $this->ScoreBoardServices->getAllTests()]);
    }
    public function allAssignments()
    {
        return view('teacher.scoreBoard.index',['type'=>'assignment','subLessons'=> $this->ScoreBoardServices->getAllAssignments()]);
    }
}

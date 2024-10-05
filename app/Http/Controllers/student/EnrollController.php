<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Services\EnrollServices;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    private $enrollService;
    public function __construct(EnrollServices $enrollServices)
    {
        $this->enrollService = $enrollServices;
    }
    public function index(){
        return view('student.courses.index',['courses'=>$this->enrollService->getMyCourses()]);
    }
    public function enroll($id)
    {
        return view('student.courses.EnrollCourse',['course'=>$this->enrollService->getCourseById($id)]);
    }
    public function payment(Request $request)
    {
        $this->enrollService->enrollCourse($request);
        return to_route('courses.index')->with('message','Successfully Enrolled');
    }
}

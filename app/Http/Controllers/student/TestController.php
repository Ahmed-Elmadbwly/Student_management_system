<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Services\SubLessonServices;
use App\Services\TestServices;
use Clue\Redis\Protocol\Model\Request;

class TestController extends Controller
{
    public $SubLessonServices;
    public $TestServices;
    public function __construct(SubLessonServices $SubLessonServices,TestServices $TestServices)
    {
        $this->SubLessonServices=$SubLessonServices;
        $this->TestServices=$TestServices;
    }
    public function index($courseId,$lessonId,$id){
        return view('student.test.index',['courseId'=>$courseId,'lessonId'=>$lessonId,'content'=>$this->SubLessonServices->showSubLesson($id)]);
    }
    public function submitAnswer(TestRequest $request,$courseId,$lessonId,$id){
        $this->TestServices->userAnswer($request,$id);
        return to_route('subLessons.index',['courseId'=>$courseId,'lessonId'=>$lessonId]);
    }
    public function showAnswer($id)
    {
        return view('student.test.show',['score'=>$this->TestServices->getScore($id),'content'=>$this->SubLessonServices->showSubLesson($id)]);
    }
}

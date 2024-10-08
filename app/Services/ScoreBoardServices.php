<?php

namespace App\Services;

use App\Models\AnswerAssignment;
use App\Models\QuizAttempt;
use Illuminate\Support\Facades\DB;

class ScoreBoardServices
{

    public function getTests()
    {
        return DB::table("lesson_tests as lt")
            ->join('sub_lessons as sl', 'sl.id', '=', 'lt.subLessonId')
            ->join('lessons as l', 'l.id', '=', 'sl.lessonId')
            ->where('l.createBy',auth()->id())
            ->select('lt.*','sl.title')->get();
    }
    public function getAllTests()
    {
        return DB::table("lesson_tests as lt")
            ->join('sub_lessons as sl', 'sl.id', '=', 'lt.subLessonId')
            ->join('lessons as l', 'l.id', '=', 'sl.lessonId')
            ->select('lt.*','sl.title')->get();
    }

    public function getScoreStudents($id)
    {
        return QuizAttempt::where('quizId', $id)->orderBy('score', 'desc')->get();
    }

    public function getAssignment()
    {
        return DB::table("assignments as a")
            ->join('sub_lessons as sl', 'sl.id', '=', 'a.subLessonId')
            ->join('lessons as l', 'l.id', '=', 'sl.lessonId')
            ->where('l.createBy',auth()->id())
            ->select('a.*','sl.title')->get();
    }
    public function getAllAssignments()
    {
        return DB::table("assignments as a")
            ->join('sub_lessons as sl', 'sl.id', '=', 'a.subLessonId')
            ->join('lessons as l', 'l.id', '=', 'sl.lessonId')
            ->select('a.*','sl.title')->get();
    }
    public function AssignmentScore($id)
    {
        return AnswerAssignment::where('assignmentId',$id)->orderBy('score', 'desc')->get();
    }
}

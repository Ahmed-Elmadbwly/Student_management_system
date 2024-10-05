<?php

namespace App\Services;

use App\Models\AnswerAssignment;
use App\Models\assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AssignmentServices
{
    public function getAssignment()
    {
        $assignments = DB::table('assignments')
            ->join('sub_lessons','assignments.subLessonId','=','sub_lessons.id')
            ->join('lessons','sub_lessons.lessonId','=','lessons.id')
            ->join('courses','lessons.courseId','=','courses.id')
            ->join('Users','lessons.createBy','=','Users.id')
            ->where('Users.id',auth()->id())
            ->select('assignments.*','sub_lessons.title','lessons.title as lesson','courses.title as course')->get();
        return $assignments;
    }

    public function getAnswerAssignment($id)
    {
        $answers = AnswerAssignment::where('assignmentId',$id)->get();
        return $answers;
    }
    public function getAnswerAssignmentById($id)
    {
        $answer = AnswerAssignment::find($id);
        return $answer;
    }
    public function createAssignment($request)
    {
        $val = $request->validate(['answerFile'=>'required' ,'title'=>'required']);
        $file = $request->file('answerFile');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('documents', $fileName, 'public');
        AnswerAssignment::create([
            'userId'=>auth()->id(),
            'assignmentId'=>$request->id,
            'answerFile'=>$fileName,
            'title'=>$request->title,
        ]);
    }
    public function deleteAssignment($id)
    {
        $answer = AnswerAssignment::find($id);
        if ( Storage::disk('public')->exists('documents/' . $answer->answerFile)) {
            Storage::disk('public')->delete('documents/' . $answer->answerFile);
        }
        $answer->delete();
    }

    public function updateAnswer($request,$id){
        $val = $request->validate(['score'=>'required']);
        AnswerAssignment::find($id)->update(['score'=>$request->score]);
    }
}

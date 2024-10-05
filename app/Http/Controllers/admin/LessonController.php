<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Services\LessonServices;

class LessonController extends Controller
{
    public $lessonServices;
    public function __construct(LessonServices $lessonServices){
        $this->lessonServices = $lessonServices;
    }

    public function index($id)
    {
        return view('admin.lessons.index',['lessons'=> $this->lessonServices->getLessons($id),
                'courseId'=>$id]);
    }


    public function create($id)
    {
        return view('admin.lessons.edit',['courseId'=>$id]);
    }


    public function store(LessonRequest $request ,$id)
    {
        $this->lessonServices->createLesson($request->toArray(),$id);
        return to_route('lessons.index',$id)->with('message','Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit($courseId, $id)
    {
        return view('admin.lessons.edit',['courseId'=>$courseId , 'lesson'=>$this->lessonServices->getLesson($id)]);
    }


    public function update(LessonRequest $request, $courseId, $id)
    {
        $this->lessonServices->updateLesson($request->toArray(),$id);
        return to_route('lessons.index',$courseId)->with('message','Successfully Updated');
    }

    public function delete($courseId, $id)
    {
        $this->lessonServices->deleteLesson($id);
        return to_route('lessons.index',$courseId)->with('message','Successfully Deleted');
    }
}

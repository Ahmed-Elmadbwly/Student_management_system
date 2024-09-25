<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubLessonRequest;
use App\Services\SubLessonServices;
use Illuminate\Http\Request;

class SubLessonController extends Controller
{
    public $SubLessonServices;

    public function __construct(SubLessonServices $SubLessonServices){
        $this->SubLessonServices = $SubLessonServices;
    }

    public function index($courseId,$lessonId)
    {
        return view('admin.lessons.sublessons.index',['courseId'=>$courseId,
            'lessonId'=>$lessonId ,'subLessons'=>$this->SubLessonServices->getSubLessons($lessonId)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId,$lessonId)
    {
        return view("admin.lessons.sublessons.create",['courseId'=>$courseId,'lessonId'=>$lessonId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubLessonRequest $request,$courseId,$lessonId)
    {
       $this->SubLessonServices->createSubLesson($lessonId,$request);
        return to_route('subLessons.index',['courseId'=>$courseId,'lessonId'=>$lessonId]);
    }

    /**
     * Display the specified resource.
     */
    public function show($courseId,$lessonId, $id)
    {
        return view('admin.lessons.sublessons.show',['content'=>$this->SubLessonServices->showSubLesson($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($courseId,$lessonId, $id)
    {
        return view('admin.lessons.sublessons.edit',['courseId'=>$courseId,
            'lessonId'=>$lessonId ,'content'=>$this->SubLessonServices->showSubLesson($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubLessonRequest $request,$courseId,$lessonId, $id)
    {
        $this->SubLessonServices->updateSubLesson($id,$request);
        return to_route('subLessons.index',['courseId'=>$courseId,'lessonId'=>$lessonId]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete ($courseId,$lessonId, $id)
    {
        $this->SubLessonServices->deleteSubLesson($id);
        return to_route('subLessons.index',['courseId'=>$courseId,'lessonId'=>$lessonId]);

    }
}

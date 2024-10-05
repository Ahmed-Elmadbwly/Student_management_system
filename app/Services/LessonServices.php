<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\SubLesson;
use App\Services\SubLessonServices;

class LessonServices
{
    function getLessons($id)
    {
        return Lesson::where('courseId', $id)->get();
    }

    public function createLesson($data,$id)
    {
        $data['createBy'] = auth()->id();
        $data['courseId'] = $id;
        return Lesson::create($data);
    }
    public function getLesson($id)
    {
        return  Lesson::find($id);
    }
    public function updateLesson($data,$id){
      return  Lesson::find($id)->update($data);
    }
    public function deleteLesson($id){
        $lesson = Lesson::find($id);
        $subLessons = SubLesson::where('lessonId', $id)->get();
        $sub = new SubLessonServices();
        foreach ($subLessons as $subLesson) {
            $sub->deleteSubLesson($subLesson->id);
        }
        return $lesson->delete();
    }
}

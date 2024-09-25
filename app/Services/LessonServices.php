<?php

namespace App\Services;

use App\Models\Lesson;

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
        return Lesson::find($id)->delete();
    }
}

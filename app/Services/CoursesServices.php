<?php

namespace App\Services;

use App\Models\categories;
use App\Models\classes;
use App\Models\Course;
use App\Models\enrollecourse;
use App\Models\Lesson;

class CoursesServices
{
    public function getAllCourses()
    {
         return Course::all();
    }
    public function getCourseById($id){
        return Course::find($id);
    }

    public function createCourse($data){
        $data['createBy']=auth()->id();
        $course = Course::create($data);
        return $course;
    }

    public function getCategories()
    {
        return categories::get();
    }
    public function getClasses()
    {
        return classes::get();
    }

    public function update($data,$id){
        return Course::find($id)->update($data);
    }
    public function delete($id){
         $course = Course::find($id);
         $lessons = Lesson::where('courseId',$id)->get();
         $les = new LessonServices;
         foreach($lessons as $lesson){
             $les->deleteLesson($lesson->id);
         }
         $enrolled = enrollecourse::where('courseId',$id)->get();
         foreach($enrolled as $enrolle){
             $enrolle->delete();
         }
         return $course->delete();
    }

}

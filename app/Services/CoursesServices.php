<?php

namespace App\Services;

use App\Models\categories;
use App\Models\classes;
use App\Models\Course;

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
        return Course::find($id)->delete();
    }

}

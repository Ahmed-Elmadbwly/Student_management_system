<?php

namespace App\Services;
use App\Models\User;
use App\Services\CoursesServices;
use Illuminate\Support\Facades\DB;


class DashBoardServices
{
    public function getCources()
    {
        return (new CoursesServices)->getAllCourses()->count();
    }
    public function getStudent()
    {
        return User::where('role', 'student')->get()->count();
    }
    public function getTeacher()
    {
        return User::where('role', 'teacher')->get()->count();
    }
    public function getAdmin()
    {
        return User::where('role', 'admin')->get()->count();
    }

    public function getPayment(){
        return DB::table('courses as c')
            ->join('enrollecourses as en','en.courseId','=','c.id')
            ->sum('c.price');
    }
}

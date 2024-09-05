<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursesRequest;
use App\Services\CoursesServices;
use Illuminate\Http\Request;

class coursesController extends Controller
{
    protected $CoursesServices;
    public function __construct(CoursesServices $CoursesServices){
        $this->CoursesServices = $CoursesServices;
    }

    public function index()
    {
        return view("admin.courses.index",["courses"=>$this->CoursesServices->getAllCourses()]);
    }

    public function create()
    {
        return view("admin.courses.edit",["categories"=>$this->CoursesServices->getCategories()
        , "classes"=>$this ->CoursesServices->getClasses()]);
    }

    public function store(CoursesRequest $request)
    {
       $this->CoursesServices->createCourse($request->toArray());
       return to_route('courses.index');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        return view("admin.courses.edit",["categories"=>$this->CoursesServices->getCategories()
            , "classes"=>$this ->CoursesServices->getClasses(),
              "course"=>$this->CoursesServices->getCourseById($id)]);
    }


    public function update(CoursesRequest $request, string $id)
    {
        $this->CoursesServices->update($request->toArray(), $id);
        return to_route("courses.index");
    }


    public function delete(string $id)
    {
        $this->CoursesServices->delete($id);
        return to_route("courses.index");
    }
}

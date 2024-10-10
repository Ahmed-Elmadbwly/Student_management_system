<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\DashBoardServices;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public $DashBoardServices;
    public function __construct(DashBoardServices $DashBoardServices){
        $this->DashBoardServices = $DashBoardServices;
    }
    public function index(){
        if(auth()->user()->role == 'admin') {
            return view('dashboard', [
                'students' => $this->DashBoardServices->getStudent(),
                'teachers' => $this->DashBoardServices->getTeacher(),
                'admin' => $this->DashBoardServices->getAdmin(),
                'courses' => $this->DashBoardServices->getCources(),
                'payment' => $this->DashBoardServices->getPayment(),
            ]);
        }else if(auth()->user()->role == 'teacher'){
            return to_route('courses.index');
        }else{
            return to_route('student.courses.index');
        }
    }
}

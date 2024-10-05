<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\categories;
use App\Models\classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class classController extends Controller
{
    public function index(){
        $classes =DB::table('classes')
            ->join('users', 'classes.createBy', '=', 'users.id')
            ->select('classes.title', 'users.name', 'classes.id')
            ->get();
        return view("admin.classes.index",["classes"=>$classes]);
    }

    public function create()
    {
        return view("admin.classes.edit");
    }

    public function store(categoryRequest $request){
        classes::create(['title'=>$request->title,'createBy'=>Auth::user()->id]);
        return redirect()->route('classes.index')->with('message','Successfully Created');

    }


    public function edit( $id)
    {
        $classes =DB::table('classes')
            ->join('users', 'classes.createBy', '=', 'users.id')
            ->select('classes.title', 'users.name', 'classes.id')
            ->where('classes.id',$id)->get();
        return view("admin.classes.edit",["class"=>$classes]);
    }

    public function update(categoryRequest $request,  $id){
        classes::find($id)->update($request->toArray());
        return redirect()->route('classes.index')->with('message','Successfully Updated');
    }

    public function delete(string $id){
        classes::find($id)->delete();
        return redirect()->route('classes.index')->with('message','Successfully Deleted');
    }
}

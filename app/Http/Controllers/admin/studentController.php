<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\student;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class studentController extends Controller
{
    function index($role)
    {
       $user = user::get()->where("role",$role);
        return view('admin.student.index',['users'=>$user,'role'=>$role]);
    }

    function create($role)
    {
        return view("admin.student.edit",['role'=>$role]);
    }

    function store(student $re,$role)
    {
        $image = $re->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('images', $imageName, 'public');
        $st = array_merge($re->toArray(), ['image' => $imageName] );
        $st['role'] = $role;
        user::create($st);
        return redirect()->route('student.index',$role)->with('message','Successfully Created');
    }

    function edit($role,$id)
    {
        $student = user::find($id);
        return view("admin.student.edit",['student'=>$student,'role'=>$role]);
    }

    function update($role,$id,student $re)
    {
        $user = user::find($id);
        $imageName = $user->image;
        if($re->file('image')){
            $image = $re->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            if ($imageName && Storage::disk('public')->exists('images/' .$user->image)) {
                Storage::disk('public')->delete('images/' . $user->image);
            }
            $image->storeAs('images', $imageName, 'public');
        }
        $pass =  $user->password;
        if($re->password != null ) $pass = $re->password;
        $st = array_merge($re->toArray(), ['image' => $imageName,'password' => $pass] );
        $user->update($st);
        return redirect()->route('student.index',$role)->with('message','Successfully Updated');
    }

    function delete($role,$id)
    {
        user::find($id)->delete();
        return redirect()->route('student.index',$role)->with('message','Successfully Deleted');
    }
}

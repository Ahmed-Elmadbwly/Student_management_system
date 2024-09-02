<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{

    public function index(){
        $category =DB::table('categories')
            ->join('users', 'categories.createBy', '=', 'users.id')
            ->select('categories.title', 'users.name', 'categories.id')
            ->get();
//        dd($category);
        return view("admin.category.index",["categories"=>$category]);
    }

    public function create()
    {
        return view("admin.category.edit");
    }

    public function store(categoryRequest $request){
        categories::create(['title'=>$request->title,'createBy'=>Auth::user()->id]);
       return redirect()->route('category.index');

    }


    public function edit( $id)
    {
        $category =DB::table('categories')
            ->join('users', 'categories.createBy', '=', 'users.id')
            ->select('categories.title', 'users.name', 'categories.id')
            ->where('categories.id',$id)->get();
        return view("admin.category.edit",["category"=>$category]);
    }

    public function update(categoryRequest $request,  $id){
        categories::find($id)->update($request->toArray());
        return redirect()->route('category.index');
    }

    public function delete(string $id){
        categories::find($id)->delete();
        return redirect()->route('category.index');
    }
}

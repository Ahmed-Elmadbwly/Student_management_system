<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Tests\Integration\Database\EloquentHasManyThroughTest\Category;

class Course extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'description',
        'price',
        'category',
        'createBy',
        'inClass'
    ];

    function category(){
        return categories::find($this->category);
    }
    function inClass()
    {
        return classes::find($this->inClass);
    }
    function createBy()
    {
        return User::find($this->createBy);
    }
}

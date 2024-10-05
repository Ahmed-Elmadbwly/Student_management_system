<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'title' , 'createBy' , 'description' , 'courseId'
    ];

    function createBy()
    {
        return User::find($this->createBy);
    }
    public function sublessons()
    {
        return $this->hasMany(SubLesson::class,'subLessonId');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

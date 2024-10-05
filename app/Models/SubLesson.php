<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLesson extends Model
{
    use HasFactory;
    protected $fillable = ['lessonId','title','type'];
    public function lesson()
    {
        return $this->belongsTo(Lesson::class,'lessonId');
    }
    public function LessonTest()
    {
        return $this->hasMany(lessonTest::class, 'subLessonId')->cascadeOnDelete();
    }
    public function LessonText()
    {
        return $this->hasMany(lessonText::class, 'subLessonId')->cascadeOnDelete();
    }
    public function assignment()
    {
        return $this->hasMany(assignment::class, 'subLessonId')->cascadeOnDelete();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lessonTest extends Model
{
    use HasFactory;
    protected $fillable = ['quizTitle', 'time', 'subLessonId'];

    public function questions()
    {
        return $this->hasMany(TestQuestion::class, 'testId');
    }

    public function subLesson()
    {
        return $this->belongsTo(SubLesson::class, 'subLessonId');
    }

}

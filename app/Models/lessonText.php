<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lessonText extends Model
{
    use HasFactory;
    protected $fillable =['videoContent','textContent','subLessonId'];
}

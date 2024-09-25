<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubLesson extends Model
{
    use HasFactory;
    protected $fillable = ['lessonId','title','type'];
}

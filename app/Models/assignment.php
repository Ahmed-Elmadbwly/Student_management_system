<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    use HasFactory;
    protected $fillable = [ 'fileTitle','subLessonId' ];
    public function subLesson(){
        return $this->belongsTo(subLesson::class);
    }
    public function getSubLesson()
    {
        return SubLesson::find($this->subLessonId);
    }
}

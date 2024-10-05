<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['questionText', 'testId','score'];

    public function options()
    {
        return $this->hasMany(TestOption::class, 'questionId');
    }

    public function test()
    {
        return $this->belongsTo(LessonTest::class, 'testId');
    }
}

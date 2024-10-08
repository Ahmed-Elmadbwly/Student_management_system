<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;
    protected $fillable =['quizId','userId','score','totalScore'];
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}

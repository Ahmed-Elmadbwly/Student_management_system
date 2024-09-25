<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerAssignment extends Model
{
    use HasFactory;
    protected $fillable = ['answerFile','userId','assignmentId'];
}

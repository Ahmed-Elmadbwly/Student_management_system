<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestOption extends Model
{
    use HasFactory;
    protected $fillable =['optionText','isCorrect','questionId'];

    public function question()
    {
        return $this->belongsTo(TestQuestion::class, 'questionId');
    }
    public function answer()
    {
        return UserAnswer::where('optionId',$this->id)->where('userId',auth()->id())->first();
    }
}

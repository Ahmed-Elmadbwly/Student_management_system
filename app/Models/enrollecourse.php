<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class enrollecourse extends Model
{
    use HasFactory;
    protected $fillable=[
        'courseId', 'userId','isEnrolled'
    ];
    public function course()
    {
        return $this->belongsTo(course::class);
    }
}

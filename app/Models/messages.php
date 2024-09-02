<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
    protected $fillable = ['conversation_id', 'sender_id', 'receiver_id', 'content'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}

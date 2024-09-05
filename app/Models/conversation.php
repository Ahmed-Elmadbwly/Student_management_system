<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    use HasFactory;
    protected $fillable =[
        'sender_id', 'receiver_id'
    ];

    public function message(){
        return $this->hasMany(messages::class);
    }

    public function getReceiver()
    {
        if($this->sender_id == auth()->id()){
            return User::firstWhere('id',$this->receiver_id);
        }else{
            return User::firstWhere('id',$this->sender_id);
        }
    }
    public function getLastMessage(){
        return messages::where(function($query) {
            $query->where('receiver_id', $this->receiver_id)
                ->where('sender_id', auth()->id());
        })
            ->orWhere(function($query) {
                $query->where('receiver_id', auth()->id())
                    ->where('sender_id', $this->receiver_id);
            })
            ->orderBy('updated_at', 'desc')
            ->first();
    }
}

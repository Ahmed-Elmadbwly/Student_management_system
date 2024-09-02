<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\messageRequest;
use App\Models\conversation;
use App\Models\messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class chatController extends Controller
{
    function getConversationId($id)
    {
        $convId = Conversation::where('receiver_id', $id)
            ->where('sender_id', Auth::id())
            ->orWhere(function ($query) use ($id) {
                $query->where('sender_id', $id)
                    ->where('receiver_id', Auth::id());
            })
            ->first();
        return $convId;
    }

    function messages($id)
    {
        return messages::where('conversation_id', $this->getConversationId($id)->id)->get();
    }

    function getConversations()
    {
        return  auth()->user()->conversations()->latest('updated_at')->get();
    }

    function index(){

        return view("chat.chat",['conversations' =>$this->getConversations()]);
    }

    function show($id){
        if(!$this->getConversationId($id)){
            conversation::create([
                'sender_id'=>Auth::id(),
                 'receiver_id'=>$id,
            ]);
        }

        $user = User::find($id);
        return view("chat.chat",['user'=>$user,
            'conversations'=>$this->getConversations(),
            'messages'=>$this->messages($id)
        ]);
    }

    function store(messageRequest $request)
    {
        $id = $request->id;
        $message=messages::create([
            "conversation_id"=>$this->getConversationId($id)->id,
            "sender_id"=>auth()->id(),
            "receiver_id"=>$request->id,
            "content"=>$request->message,
        ]);
        broadcast(new MessageSent($message));

        return $message;
    }

}

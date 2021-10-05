<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('Chat/Container');
    }

    public function rooms()
    {
        return ChatRoom::all();
    }

    public function message($roomId)
    {
        // return ChatMessage::where('room_id', $roomId)->orderBy('created_at', 'asc')->get();
        // return ChatMessage::where('chat_room_id', $roomId)->latest()->get();
        // $chats = ChatMessage::where('chat_room_id', $roomId)->latest()->get();
        // $user = $chats[0]->user->name;
        // dd($user);
        // chatmessage model에서 관계를 정의 했으므로 접근 가능

        return ChatMessage::where('chat_room_id', $roomId)->with('user')->latest()->get();

        //fresh에 모델에 정의한 관계 메소드를 부르면 with와 똑같음 -> 조인된 결과가 나온다.
        // $chat = ChatMessage::where('chat_room_id', $roomId)->get();
        // return $chat->fresh('user');
    }
    public function newMessage(Request $request, $roomId)
    {
        $request->validate(['message' => 'required|min:1']);
        $chat = ChatMessage::create([
            'user_id' => auth()->user()->id,
            'chat_room_id' => $roomId,
            'message' => $request->message,
        ]);
        return $chat;
    }
}

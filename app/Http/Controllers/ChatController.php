<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\ChatMessage;
use app\Models\ChatRoom;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function rooms( Request $request) {
        return ChatRoom::all();
    }
    public function messages( Request $request, $roomId) {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function newMessage( Request $request, $roomId) {
        $newMessage = new ChatMessage;
        $newMessage->user_Id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();


        return $newMessage;
    }
}

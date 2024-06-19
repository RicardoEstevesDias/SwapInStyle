<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index(){

        $conversations = Conversation::query()
            ->with("conversationUser.user")
            ->whereRelation("conversationUser", "user_id", Auth::id())
            ->orderBy("created_at", "DESC")
            ->paginate(12);

        return view("chat.index", compact("conversations"));
    }


    public function findConversation(User $user){
        $conversation = Conversation::query()
            ->with("message")
            ->whereRelation("conversationUser", "user_id", Auth::id())
            ->whereRelation("conversationUser", "user_id", $user->id)
            ->get();

        if($conversation->isEmpty()){
            return redirect()->route("conversation.create", $user);
        }
        else{
            return redirect()->route('conversation.show', $conversation[0]->id);
        };
    }


    public function createConversation(User $user){
        $conversation = Conversation::query()->create();
        ConversationUser::query()->create([
            "conversation_id" =>  $conversation->id,
            "user_id" => Auth::id(),
        ]);
        ConversationUser::query()->create([
            "conversation_id" =>  $conversation->id,
            "user_id" => $user->id,
        ]);

        return redirect()->route('conversation.show', $conversation);
    }


    public function chat(Conversation $conversation){

        $conversation = $conversation->load("message", "conversationUser.user");
        $messages = $conversation->message;

        return view("chat.show", compact('conversation', 'messages'));
    }


    public function sendMessage(Request $request, Conversation $conversation){

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        Message::query()->create([
            "conversation_id" =>  $conversation->id,
            "user_id" => Auth::id(),
            "message" => $validated["message"],
        ]);

        return redirect()->route('conversation.show', $conversation);
    }
}

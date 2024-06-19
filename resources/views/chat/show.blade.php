@extends('layouts.app')
@section('body')

    <div class="w-full flex items-center flex-col">
        <h2 class="text-4xl font-bold">
            @unless($conversation->conversationUser[0] === Auth::user()->name )
                {{$conversation->conversationUser[0]->user->name}}
            @else
                {{$conversation->conversationUser[1]->user->name}}
            @endif
        </h2>
        <div class="w-full shadow-2xl bg-accent-200 p-6 rounded-2xl">
            <div class="min-w-lg">
                @foreach($messages as $message)
                    @if($message->user_id === Auth::id())
                        <div class="chat chat-end">
                            <div class="chat-bubble">{{$message->message}}</div>
                        </div>
                    @else
                        <div class="chat chat-start">
                            <div class="chat-bubble">{{$message->message}}</div>
                        </div>
                    @endif
                @endforeach
            </div>
            <form class="text-center fixed inset-x-0 bottom-0  p-4" action="{{route("conversation.send", $conversation)}}" method="post">
                @csrf
                @include("components.text-input", [
                'name' => 'message',
                'placeholder' => 'Ecrivez votre message ici',
            ])
                <button class="btn btn-info" type="submit"> Envoyer</button>
            </form>
        </div>
    </div>

@endsection

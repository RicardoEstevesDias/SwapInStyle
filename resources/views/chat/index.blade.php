@extends("layouts.app")

@section("body")
@foreach($conversations as $conversation)
    <a class="btn btn-primary" href="{{route("conversation.show", $conversation->id)}}"> Conversation avec
    @unless($conversation->conversationUser[0] === Auth::user()->name )
        {{$conversation->conversationUser[0]->user->name}}
    @else
        {{$conversation->conversationUser[1]->user->name}}
    @endif

    </a>
@endforeach


@endsection

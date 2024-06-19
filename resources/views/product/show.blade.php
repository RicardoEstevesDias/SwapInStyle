@extends('layouts.app')

@section('body')
    <div class="card lg:card-side bg-base-100 shadow-xl">
        <figure class="w-full max-w-md">
            <img @if ($product->status === "vendu") class="brightness-50" @endif src="/storage/{{ $product->image }}" alt="Album" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ $product->title }} <b>@if ($product->status === "vendu") (Vendu le {{$product->transaction->created_at->format('j M Y, H:i')}})@endif</b></h2>
            <p>Description : {{ $product->description }}</p>
            <p>Prix : {{ number_format($product->price, 2, '.', '') }}€</p>
            <p>Genre :
                @if ($product->gender == 'male')
                    Homme
                @elseif ($product->gender == 'female')
                    Femme
                @else
                    Unisexe
                @endif
            </p>
            <p>Taille: {{ Str::upper($product->size) }}</p>
            <p>Marque : {{ $product->brand->name }}</p>
            <p>Couleur : {{ $product->color->name }}</p>
            <p>Type : {{ $product->type->name }}</p>
            <p>Publié par <b>{{ $product->user->name }}</b>,
                le {{ $product->created_at->format('j M Y, H:i') }}
                @unless ($product->created_at->eq($product->updated_at))
                    <small class="text-sm text-gray-600"> &middot; modifié</small>
                @endunless

            </p>
            @php
                $user = Auth::user();
            @endphp
            @unless ($user->id === $product->user_id || $product->status === "vendu")
                <form action="{{ route('transaction.store', $product) }}" method="post">
                    @csrf
                    <button class="btn btn-success" type="submit">Acheter</button>
                </form>
            @endunless
        </div>
    </div>
@endsection

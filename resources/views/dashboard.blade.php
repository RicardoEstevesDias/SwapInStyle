@extends('layouts.app')

@section('body')
    <div class="flex justify-around flex-wrap gap-5">

        @foreach ($products as $product)
            <div class="card w-96 bg-base-100 shadow-xl">
                <figure>
                    <img src="/storage/{{ $product->image }}" alt="..." />
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $product->title }}</h2>
                    <p class="truncate">{{ $product->description }}</p>
                    <p>Prix: {{number_format($product->price, 2, '.', '')}}€ </p>
                    <div class="flex justify-between">
                        @can('update', $product)
                            <div class="dropdown card-actions justify-start">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-list" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                </button>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                    <li>
                                        <a href="{{ route('product.edit', $product) }}">Modifier</a>
                                    </li>
                                    <hr class="dropdown-divider">
                                    <li>
                                        <form action="{{ route('product.destroy', $product) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="link-error" type="submit">Supprimer</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                        <p>Publié par <a href="{{route("profile", $product->user_id)}}" class="font-bold">{{$product->user->name}}</a></p>
                        @endcan

                        <div class="card-actions justify-end">
                            <a href="{{ route('product.show', $product) }}" class="btn btn-accent">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    {{$products->links('pagination::tailwind')}}
@endsection

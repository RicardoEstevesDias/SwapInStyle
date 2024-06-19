@extends('layouts.app')

@section('profile')
    <div class="">
        <div class="w-screen bg-base-200 py-10 flex justify-evenly gap-5">
            <div class="flex">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar mx-16 group">
                    <svg class="absolute top-12 group-hover:stroke-white transition duration-150 ease-out z-10"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                    </svg>
                    @unless ($user->profile_photo)
                        <div class="bg-neutral group-hover:bg-neutral-800 text-neutral-content group-hover:text-neutral-600 rounded-full min-w-32 h-32 shadow-2xl transition duration-150 ease-out">
                            <a href="#modif" class="text-9xl hover:cursor-default select-none">{{ Str::upper($user->name[0]) }}</a>
                        </div>
                    @else
                        <div class="rounded-full min-w-32 h-32 shadow-2xl group-hover:brightness-50 transition duration-150 ease-out">
                            <a href="#modif">
                                <img alt="Tailwind CSS Navbar component"
                                src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                            </a>
                        </div>
                    @endunless
                </div>
                <div>
                    <h1 class="text-5xl font-bold">{{ $user->name }}</h1>
                    <div class="flex gap-9">
                        <h2 class="py-6">Produits vendus: {{ $sold }}</h2>

                        <h2 class="py-6">Note:</h2>
                    </div>
                </div>
            </div>
            <div>
                @if ($user->id === Auth::id())
                    <a href="#modifpro" class="btn btn-accent">Modifier profil</a>
                @else
                    <a href="{{route("conversation.find", $user)}}" class="btn btn-secondary">Contacter</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('body')

    <div class="collapse collapse-arrow border bg-base-200 mb-5">
        <input type="checkbox" name="articles" checked="checked" />
        <div class="collapse-title text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            Articles
        </div>
        <div class="collapse-content">
            <div class="flex justify-around flex-wrap gap-5 pb-16">

                @foreach ($products as $product)
                    @if ($product->status === 'disponible')
                        <div class="card w-96 bg-base-100 shadow-xl">
                            <figure>
                                <img src="/storage/{{ $product->image }}" alt="..." />
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">{{ $product->title }} </h2>
                                <p class="truncate">{{ $product->description }}</p>
                                <div class="flex justify-between">
                                    @can('update', $product)
                                        <div class="dropdown card-actions justify-start">
                                            <button class="btn" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                                                </svg>
                                            </button>
                                            <ul tabindex="0"
                                                class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
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
                                        <p>Publié le <b class="font-bold">{{ $product->created_at->format('j M Y') }}</b></p>
                                    @endcan
                                    <div class="card-actions justify-end">
                                        <a href="{{ route('product.show', $product) }}" class="btn btn-accent">En savoir
                                            plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="collapse collapse-arrow bg-base-200">
        <input type="checkbox" name="articles" />
        <div class="collapse-title text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
            Articles vendus
        </div>
        <div class="collapse-content">
            <div class="flex justify-around flex-wrap gap-5">

                @foreach ($products as $product)
                    @if ($product->status === 'vendu')
                        <div class="card w-96 bg-base-100 shadow-xl">
                            <figure>
                                <img class="brightness-50" src="/storage/{{ $product->image }}" alt="..." />
                            </figure>
                            <div class="card-body">
                                <h2 class="card-title">{{ $product->title }}<b class="text-bold">(Vendu)</b></h2>
                                <p class="truncate">{{ $product->description }}</p>
                                <div class="flex justify-between">
                                    <p class="py-2 font-bold">Vendu le: {{$product->transaction->created_at->format('j M Y')}} </p>
                                    <div class="card-actions justify-end">
                                        <a href="{{ route('product.show', $product) }}" class="btn btn-accent">En savoir
                                            plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>


    {{ $products->links('pagination::tailwind') }}
@endsection

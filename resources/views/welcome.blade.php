@extends('layouts.guest')

@section('body')
    <div class="navbar bg-base-100">
        <div class="flex-1">
            <a class="font-bold px-4 text-xl hover:cursor-default select-none">SwapInStyle</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1 gap-2">
                @auth
                    <li>
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Dashboard
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('register') }}"
                            class="btn btn-accent rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            S'inscrire
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="btn rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Se connecter
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

    @include('components.flash')
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <img src="https://img.daisyui.com/images/stock/photo-1635805737707-575885ab0820.jpg"
                class="max-w-sm rounded-lg shadow-2xl" />
            <div>
                <h1 class="text-5xl font-bold">Bienvenue!</h1>
                <p class="py-6">
                    Vous voulez donner une seconde vie à vos vêtements?
                    <br>
                    Voici SwapInStyle un site où vous pourrez vendre vous
                    <br>
                    vêtements et les trouver un nouveau propriétaire.
                </p>
                <a href="{{ route('register') }}" class="btn btn-accent">Inscrivez-vous ici!</a>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.guest')
@section('body')
    <div class="flex flex-col items-center justify-center min-h-screen">

        <h1 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl flex-auto">Page d'inscription</h1>

        <div class="w-full max-w-xs flex-auto">

            <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                @include('components.text-input', [
                    'name' => 'name',
                    'label' => "Nom d'utilisateur",
                    'placeholder' => 'Jean Dupont',
                    'value' => old('name'),
                ])
                @include('components.text-input', [
                    'name' => 'email',
                    'label' => 'E-mail',
                    'placeholder' => 'example@domaine.net',
                    'type' => 'email',
                    'value' => old('email'),
                ])
                @include('components.text-input', [
                    'name' => 'password',
                    'label' => 'Mot-de-passe',
                    'placeholder' => '**********',
                    'type' => 'password',
                    'value' => old('password'),
                ])

                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2"
                    type="submit">
                    S'inscrire
                </button>

                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                    href="{{ route('login') }}">
                    &nbsp; Déjà inscrit?
                </a>
            </form>
        </div>
    </div>
@endsection

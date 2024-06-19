@extends('layouts.guest')

@section('body')
    <div class="flex flex-col items-center justify-center min-h-screen">

        <h1 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl flex-auto">Nouveau mot-de-passe
        </h1>

        <div class="w-full max-w-xs flex-auto">
            <form action="{{ route('password.update') }}" method="post"
                class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                @include('components.text-input', [
                    'name' => 'email',
                    'label' => 'E-mail',
                    'placeholder' => 'Votre e-mail',
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
                @include('components.text-input', [
                    'name' => 'password_confirmation',
                    'label' => 'Confirmer mot-de-passe',
                    'placeholder' => '**********',
                    'type' => 'password',
                    'value' => old('password'),
                ])

                @include('components.flash')


                <input type="hidden" name="token" value="{{ $token }}">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2"
                    type="submit">
                    Confirmer
                </button>
            </form>
        </div>
    </div>
@endsection

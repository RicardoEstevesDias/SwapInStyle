@extends('layouts.app')

@section('body')
<div class="flex flex-col items-center justify-center min-h-screen">

    <h1 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl flex-auto">
        Modifier "{{$name}}"
    </h1>

    <a href="{{ route('category.index') }}" class="btn">
            <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M19 12H6M12 5l-7 7 7 7" />
        </svg> Retour vers "Catégories"
    </a>

    <div class="w-full max-w-screen-sm flex-auto">
        <form action="{{route("category.update", ["category" => "$category" , "id" => $id])}}" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <input name="name"
                class="input input-bordered w-full max-w-xs mb-2 join-item @error('name') input-error @enderror"
                value="{{$name}}"
                />
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2"
                type="submit"
                >
                Confimer
            </button>
        </form>.
        @error('name')
            @include('components.error-alert', ['message' => $message])
        @enderror
        @error('category')
            @include('components.error-alert', ['message' => $message])
        @enderror

    </div>
</div>

@endsection

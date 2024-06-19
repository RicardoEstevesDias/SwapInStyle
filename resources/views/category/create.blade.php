@extends('layouts.app')


@section('body')
    <div class="flex flex-col items-center justify-center min-h-screen">

        <h1 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl flex-auto">Création d'une catégorie</h1>

        <a href="{{ route('category.index') }}" class="btn">
                <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M19 12H6M12 5l-7 7 7 7" />
            </svg> Retour vers "Catégories"
        </a>

        <div class="w-full max-w-screen-sm flex-auto">
            <form id="category-form" action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="join">
                    <input id="category-input" name="name"
                        class="input input-bordered w-full max-w-xs mb-2 join-item @error('name') input-error @enderror"
                        placeholder="Aucune catégorie" disabled/>
                    <select id="category-select" name="category"
                        class="select select-bordered join-item rounded-r-full @error('category') select-error @enderror"
                        required>
                        <option value="" disabled selected>--Selectionner catégorie--</option>
                        <option value="brand" {{ old('category') == 'brand' ? 'selected=' . '"' . 'selected' . '"' : '' }}>Marque
                        </option>
                        <option value="color" {{ old('category') == 'color' ? 'selected=' . '"' . 'selected' . '"' : '' }}>Couleur
                        </option>
                        <option value="type" {{ old('category') == 'type' ? 'selected=' . '"' . 'selected' . '"' : '' }}>Type
                        </option>
                    </select>
                </div>

                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2"
                    type="submit">
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

    <script>
        let form = document.querySelector("#category-form");
        let select = document.querySelector("#category-select");
        let input = document.querySelector("#category-input");
        document.addEventListener('onload', inputModifier);
        select.addEventListener('change', inputModifier);
        function inputModifier() {
            if (select.value) {
            input.disabled = false;
            }
            if (select.value === "brand") {
                input.placeholder = "Marque";
            } else if (select.value === "color") {
                input.placeholder = "Couleur";
            } else if (select.value === "type") {
                input.placeholder = "Type";
            }
            input.focus()
        }
    </script>
@endsection

@extends('layouts.app')

@section('body')

<div class="flex flex-col items-center justify-center min-h-screen">

    <h1 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl flex-auto">Création d'un article</h1>

    <div class="w-full max-w-sm flex-auto">

        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
            @csrf
            @include('components.text-input', [
                'name' => 'title',
                'label' => "Titre",
                'placeholder' => 'T-shirt chic',
                'value' => old('title'),
            ])
            @include('components.text-input', [
                'name' => 'description',
                'label' => 'Description',
                'placeholder' => 'Décrivez votre article ici',
                'type' => 'textarea',
                'value' => old('description'),
            ])
            @include('components.text-input', [
                'name' => 'price',
                'label' => 'Prix (en €)',
                'placeholder' => '74.99',
                'type' => 'number',
                "min" => "0",
                "max" => "999999.99",
                "step" => "0.01",
                'value' => old('price'),
            ])

            @include('components.radio-input',[
                'name' => 'gender',
                'label' => 'Genre',
                'radios' => [
                    [
                        "value" => "male",
                        "label" => "Homme"
                    ],
                    [
                        "value" => "female",
                        "label" => "Femme"
                    ],
                    [
                        "value" => "unisex",
                        "label" => "Unisexe"
                    ]
                ]
            ])
            @include('components.radio-input',[
                'name' => 'size',
                'label' => 'Taille',
                'radios' => [
                    [
                        "value" => "xs",
                        "label" => "XS"
                    ],
                    [
                        "value" => "s",
                        "label" => "S"
                    ],
                    [
                        "value" => "m",
                        "label" => "M"
                    ],
                    [
                        "value" => "l",
                        "label" => "L"
                    ],
                    [
                        "value" => "xl",
                        "label" => "XL"
                    ]
                ]
            ])

            @include('components.select-input',[
                'name' => 'brand_id',
                'label' => 'Marque',
                'options' => $brands
            ])
            @include('components.select-input',[
                'name' => 'color_id',
                'label' => 'Couleur',
                'options' => $colors
            ])
            @include('components.select-input',[
                'name' => 'type_id',
                'label' => 'Type',
                'options' => $types
            ])

            @include('components.file-input',[
                'name' => 'image',
                'label' => 'Sélectionnez une image',
                'value' => old('image'),
            ])

            <button
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-2"
            type="submit">
            Confimer
            </button>

        </form>
    </div>
</div>
@endsection

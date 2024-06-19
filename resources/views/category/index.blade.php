@extends('layouts.app')

@section('body')
    <div class="flex flex-wrap gap-5">

        <div class="overflow-x-auto">
            <h2 class="text-3xl text-center font-bold mb-2">Marques</h2>
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date de création</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->created_at}}</td>
                            <td class="flex gap-2">
                                <a class="btn btn-accent" href="{{route("category.edit", ["category" => "brand" , "id" => $brand])}}">Modifier</a>
                                <form action="{{route("category.destroy", [ "category" => "brand" , "id" => $brand])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-error" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto">
            <h2 class="text-3xl text-center font-bold mb-2">Couleurs</h2>
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date de création</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colors as $color)
                        <tr value={{$color->id}}>
                            <td>{{$color->name}}</td>
                            <td>{{$color->created_at}}</td>
                            <td class="flex gap-2">
                                <a class="btn btn-accent" href="{{route("category.edit", ["category" => "color" , "id" => $color])}}">Modifier</a>
                                <form action="{{route("category.destroy", ["category" => "color" , "id" => $color])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-error" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="overflow-x-auto">
            <h2 class="text-3xl text-center font-bold mb-2">Types</h2>
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Date de création</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr value={{$type->id}}>
                            <td>{{$type->name}}</td>
                            <td>{{$type->created_at}}</td>
                            <td class="flex gap-2">
                                <a class="btn btn-accent" href="{{route("category.edit", ["category" => "type" , "id" => $type])}}">Modifier</a>
                                <form action="{{route("category.destroy", ["category" => "type" , "id" => $type])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-error" type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

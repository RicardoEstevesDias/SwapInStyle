@extends('layouts.app')

@section('body')

<div class="container flex flex-wrap justify-evenly w-screen gap-2 mt-4">
    <div class="w-auto rounded p-4">
        <h2 class="text-center">Vos achats</h2>

        <div class="p-4">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Vendeur</th>
                    <th scope="col">Article</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                    @if($estVideAchats)
                        <tr>
                            <td colspan="4" class="text-center">Vous n'avez effectué aucun achat</td>
                        </tr>
                    @else
                        @foreach ($achats as $achat)

                            <tr>
                                <th scope="row"><a href="{{route("profile", $achat->seller->id)}}">{{$achat->seller->name}}</a></th>
                                <td><a href="{{route("product.show", $achat->product->id)}}">{{$achat->product->title}}</a></td>
                                <td>{{$achat->amount}} €</td>
                                <td>{{$achat->created_at->format('j M Y, H:i')}}</td>
                            </tr>

                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="w-auto rounded p-4">
        <h2 class="text-center">Vos ventes</h2>
        <div class="p-4">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Acheteur</th>
                    <th scope="col">Article</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Date</th>
                  </tr>
                </thead>
                <tbody>
                    @if($estVideVentes)
                        <tr>
                            <td colspan="4" class="text-center">Vous n'avez vendu aucun article</td>
                        </tr>
                    @else
                        @foreach ($ventes as $vente)

                            <tr>
                                <th scope="row"><a href="{{route("profile", $vente->buyer->id)}}">{{$vente->buyer->name}}</a></th>
                                <td><a href="{{route("product.show", $vente->product->id)}}">{{$vente->product->title}}</a></td>
                                <td>{{$vente->amount}} €</td>
                                <td>{{$vente->created_at->format('j M Y, H:i')}}</td>
                            </tr>

                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

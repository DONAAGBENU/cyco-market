@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mon panier</h1>

    @if(empty($cart) || count($cart) === 0)
        <p>Votre panier est vide.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] ?? 'Produit inconnu' }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'], 2) }} €</td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 2) }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('orders.create') }}" class="btn btn-primary">Passer commande</a>
        <a href="{{ route('home') }}" class="btn btn-secondary">Continuer mes achats</a>
    @endif
</div>
@endsection

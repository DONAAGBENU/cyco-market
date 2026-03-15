@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes commandes</h1>

    @if($orders->isEmpty())
        <p>Vous n'avez passé aucune commande pour le moment.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($order->total_amount, 2) }} €</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-primary">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    @endif
</div>
@endsection

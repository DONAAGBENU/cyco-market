@extends('layouts.app')

@section('title', 'Détails client - ' . $user->name)

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="bg-gray-800 text-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-4 text-yellow-400">{{ $user->name }} (ID: {{ $user->id }})</h1>
        <p class="mb-2"><strong class="text-yellow-300">Email:</strong> <span class="text-gray-200">{{ $user->email }}</span></p>
        <p class="mb-2"><strong class="text-yellow-300">Téléphone:</strong> <span class="text-gray-200">{{ $user->phone ?? '-' }}</span></p>
        <p class="mb-2"><strong class="text-yellow-300">Adresse:</strong> <span class="text-gray-200">{{ $user->address ?? '-' }}</span></p>
        <p class="mb-2"><strong class="text-yellow-300">Inscrit le:</strong> <span class="text-gray-200">{{ $user->created_at->format('d/m/Y H:i') }}</span></p>
        <p class="mb-2"><strong class="text-yellow-300">Dernière connexion:</strong> <span class="text-gray-200">{{ $user->last_login ? $user->last_login->format('d/m/Y H:i') : '-' }}</span></p>
        <p class="mb-2"><strong class="text-yellow-300">Statut:</strong> <span class="text-green-400">{{ $user->is_banned ? 'Banni' : 'Actif' }}</span></p>

        <div class="mt-4 flex space-x-2">
            @if(!$user->is_banned)
                <form action="{{ route('admin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Bannir ce client ?')">
                    @csrf
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Bannir</button>
                </form>
            @else
                <form action="{{ route('admin.users.unban', $user) }}" method="POST" onsubmit="return confirm('Réactiver ce client ?')">
                    @csrf
                    <button class="bg-green-500 text-white px-4 py-2 rounded">Réactiver</button>
                </form>
            @endif
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ce client ?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
            </form>
        </div>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-4 text-yellow-400">Commandes</h2>
        @if($orders->isEmpty())
            <p class="text-gray-400">Ce client n'a passé aucune commande.</p>
        @else
            <table class="min-w-full text-white">
                <thead>
                    <tr class="border-b border-gray-600">
                        <th class="py-2 text-left">#</th>
                        <th class="py-2 text-left">Montant</th>
                        <th class="py-2 text-left">Statut</th>
                        <th class="py-2 text-left">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-b border-gray-700">
                            <td class="py-2">{{ $order->order_number }}</td>
                            <td class="py-2">{{ number_format($order->total_amount,0,',',' ') }} F</td>
                            <td class="py-2">{{ ucfirst($order->status) }}</td>
                            <td class="py-2">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection

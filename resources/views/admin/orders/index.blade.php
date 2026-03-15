@extends('layouts.app')

@section('title', 'Gestion des commandes - CYCO MARKET')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Gestion des commandes</h1>

        <!-- Filtres rapides -->
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Toutes</a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-lg hover:bg-yellow-200 transition">En attente</a>
            <a href="{{ route('admin.orders.index', ['status' => 'processing']) }}" class="px-4 py-2 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition">En cours</a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" class="px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition">Terminées</a>
            <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" class="px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition">Annulées</a>
        </div>

        <!-- Tableau des commandes -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">N° Commande</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Client</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-4 font-mono text-sm">#{{ $order->order_number }}</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-sm font-bold mr-2">
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                </div>
                                <span>{{ $order->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 font-semibold">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</td>
                        <td class="px-4 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'completed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-600">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-4">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="text-blue-600 hover:text-blue-800 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
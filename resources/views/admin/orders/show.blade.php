@extends('layouts.app')

@section('title', 'Détails commande - CYCO MARKET')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="mb-6">
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Retour aux commandes
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informations commande -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Commande #{{ $order->order_number }}</h1>
                        <p class="text-gray-600">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="flex items-center">
                        @csrf
                        <select name="status" class="border rounded-lg px-3 py-2 mr-2">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>En cours</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Terminée</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Mettre à jour
                        </button>
                    </form>
                </div>

                <!-- Produits commandés -->
                <h3 class="font-semibold text-gray-800 mb-4">Produits commandés</h3>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                        <div class="flex items-center space-x-4">
                            @if($item->product->images && count($item->product->images) > 0)
                                <img src="{{ asset('storage/' . $item->product->images[0]) }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-16 h-16 object-cover rounded-lg">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-600">Quantité: {{ $item->quantity }}</p>
                            </div>
                        </div>
                        <p class="font-bold text-blue-600">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</p>
                    </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="mt-6 pt-6 border-t">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-gray-800">Total</span>
                        <span class="text-2xl font-bold text-blue-600">{{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations client -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Informations client</h3>
                
                <div class="space-y-4">
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Nom</p>
                        <p class="font-semibold">{{ $order->user->name }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Email</p>
                        <p class="font-semibold">{{ $order->user->email }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Téléphone</p>
                        <p class="font-semibold">{{ $order->user->phone ?? 'Non renseigné' }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Adresse de livraison</p>
                        <p class="font-semibold">{{ $order->shipping_address }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Mode de paiement</p>
                        <p class="font-semibold">{{ $order->payment_method }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-xl">
                        <p class="text-sm text-gray-600 mb-1">Statut paiement</p>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            @if($order->payment_status == 'paid') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                            {{ $order->payment_status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
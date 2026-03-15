@extends('layouts.app')

@section('title', 'Produits - CYCO MARKET')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex gap-8">
        <!-- Sidebar Filtres -->
        <div class="w-64 flex-shrink-0">
            <div class="bg-gray-800 text-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-lg mb-4 text-yellow-400">Catégories</h3>
                <div class="space-y-2">
                    <a href="{{ route('products.index') }}" 
                       class="block text-gray-300 hover:text-blue-400 {{ !request('category') ? 'font-semibold text-blue-400' : '' }}">
                        Tous les produits
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" 
                           class="block text-gray-300 hover:text-blue-400 {{ request('category') == $category->id ? 'font-semibold text-blue-400' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <h3 class="font-semibold text-lg mt-6 mb-4 text-yellow-400">Prix</h3>
                <form action="{{ route('products.index') }}" method="GET" class="space-y-2">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    
                    <div>
                        <label class="block text-sm text-gray-300">Min</label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" 
                               class="w-full px-3 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-300">Max</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" 
                               class="w-full px-3 py-2 border border-gray-600 rounded-lg bg-gray-700 text-white">
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Filtrer
                    </button>
                </form>
            </div>
        </div>

        <!-- Liste des produits -->
        <div class="flex-1">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-gray-800 text-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                        <a href="{{ route('products.show', $product->slug) }}">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-700 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-500 text-4xl"></i>
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2 text-yellow-400">{{ $product->name }}</h3>
                                <p class="text-gray-300 text-sm mb-2">{{ Str::limit($product->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-2xl font-bold text-yellow-400">
                                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                                    </span>
                                    <span class="text-sm text-gray-400">Stock: {{ $product->quantity }}</span>
                                </div>
                                <p class="text-sm text-gray-400 mt-2">
                                    Commande min: {{ $product->min_order_quantity }} unité(s)
                                </p>
                            </div>
                        </a>
                        <div class="p-4 border-t border-gray-600">
                            <form action="{{ route('cart.add') }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="{{ $product->min_order_quantity }}" 
                                       min="{{ $product->min_order_quantity }}" max="{{ $product->quantity }}"
                                       class="w-20 px-2 py-1 border border-gray-600 rounded bg-gray-700 text-white">
                                <button type="submit" class="flex-1 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    <i class="fas fa-cart-plus mr-2"></i>Ajouter
                                </button>
                            </form>
                            <a href="{{ route('products.show', $product->slug) }}" class="block text-center mt-2 text-sm text-gray-300 hover:text-blue-400">
                                Voir / Contacter
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-400">Aucun produit trouvé.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
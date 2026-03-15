@extends('layouts.app')

@section('title', $product->name . ' - CYCO MARKET')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="grid grid-cols-2 gap-8 p-8">
            <!-- Images -->
            <div>
                @if($product->images && count($product->images) > 0)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $product->images[0]) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-96 object-cover rounded-lg" 
                             id="mainImage">
                    </div>
                    @if(count($product->images) > 1)
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($product->images as $index => $image)
                                <img src="{{ asset('storage/' . $image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75"
                                     onclick="document.getElementById('mainImage').src = this.src">
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-6xl"></i>
                    </div>
                @endif
            </div>

            <!-- Informations produit -->
            <div>
                <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                
                <div class="mb-4">
                    <span class="text-4xl font-bold text-blue-600">
                        {{ number_format($product->price, 0, ',', ' ') }} FCFA
                    </span>
                </div>

                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-2">Description</h3>
                    <p class="text-gray-700">{{ $product->description }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <span class="text-gray-600">Disponibilité:</span>
                        <span class="font-semibold {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->quantity > 0 ? 'En stock' : 'Rupture' }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600">Quantité en stock:</span>
                        <span class="font-semibold">{{ $product->quantity }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Commande minimum:</span>
                        <span class="font-semibold">{{ $product->min_order_quantity }} unité(s)</span>
                    </div>
                    <div>
                        <span class="text-gray-600">SKU:</span>
                        <span class="font-semibold">{{ $product->sku }}</span>
                    </div>
                    @if($product->supplier)
                    <div>
                        <span class="text-gray-600">Fournisseur:</span>
                        <span class="font-semibold">{{ $product->supplier }}</span>
                    </div>
                    @endif
                    @if($product->origin)
                    <div>
                        <span class="text-gray-600">Origine:</span>
                        <span class="font-semibold">{{ $product->origin }}</span>
                    </div>
                    @endif
                </div>

                @if($product->specifications)
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-2">Spécifications</h3>
                    <table class="min-w-full">
                        @foreach($product->specifications as $key => $value)
                        <tr class="border-b">
                            <td class="py-2 text-gray-600">{{ $key }}</td>
                            <td class="py-2 font-semibold">{{ $value }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif

                @if($product->quantity > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Quantité</label>
                        <input type="number" name="quantity" value="{{ $product->min_order_quantity }}" 
                               min="{{ $product->min_order_quantity }}" max="{{ $product->quantity }}"
                               class="w-24 px-3 py-2 border rounded-lg">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm text-gray-600 mb-1">&nbsp;</label>
                        <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                            <i class="fas fa-cart-plus mr-2"></i>Ajouter au panier
                        </button>
                    </div>
                </form>
                @else
                    <div class="bg-red-100 text-red-700 px-6 py-3 rounded-lg text-center">
                        Produit temporairement en rupture de stock
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Produits similaires -->
    @if($relatedProducts->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6">Produits similaires</h2>
        <div class="grid grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                    <a href="{{ route('products.show', $relatedProduct->slug) }}">
                        @if($relatedProduct->images && count($relatedProduct->images) > 0)
                            <img src="{{ asset('storage/' . $relatedProduct->images[0]) }}" 
                                 alt="{{ $relatedProduct->name }}" 
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-4">
                            <h3 class="font-semibold">{{ $relatedProduct->name }}</h3>
                            <p class="text-xl font-bold text-blue-600 mt-2">
                                {{ number_format($relatedProduct->price, 0, ',', ' ') }} FCFA
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
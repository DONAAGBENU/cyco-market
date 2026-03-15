@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Paiement de la commande</h1>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div class="mb-4">
            <label for="shipping_address" class="block font-medium text-sm text-gray-700">Adresse de livraison</label>
            <input id="shipping_address" type="text" name="shipping_address" value="{{ old('shipping_address') }}" class="w-full border rounded px-3 py-2" required>
            @error('shipping_address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label for="billing_address" class="block font-medium text-sm text-gray-700">Adresse de facturation</label>
            <input id="billing_address" type="text" name="billing_address" value="{{ old('billing_address') }}" class="w-full border rounded px-3 py-2" required>
            @error('billing_address')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label for="payment_method" class="block font-medium text-sm text-gray-700">Mode de paiement</label>
            <select id="payment_method" name="payment_method" class="w-full border rounded px-3 py-2" required>
                <option value="card"{{ old('payment_method')=='card' ? ' selected' : '' }}>Carte bancaire</option>
                <option value="paypal"{{ old('payment_method')=='paypal' ? ' selected' : '' }}>PayPal</option>
                <option value="bank_transfer"{{ old('payment_method')=='bank_transfer' ? ' selected' : '' }}>Virement bancaire</option>
            </select>
            @error('payment_method')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label for="notes" class="block font-medium text-sm text-gray-700">Notes</label>
            <textarea id="notes" name="notes" class="w-full border rounded px-3 py-2">{{ old('notes') }}</textarea>
            @error('notes')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
        </div>

        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Confirmer la commande</button>
    </form>
</div>
@endsection

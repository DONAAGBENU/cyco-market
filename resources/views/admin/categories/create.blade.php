@extends('layouts.app')

@section('title', 'Nouvelle catégorie - CYCO MARKET')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Ajouter une catégorie</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Nom</label>
                <input type="text" name="name" value="{{ old('name') }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full px-3 py-2 border rounded">{{ old('description') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Image</label>
                <input type="file" name="image" accept="image/*" class="w-full">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Modifier catégorie - CYCO MARKET')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Modifier la catégorie</h1>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nom</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                       class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" rows="3" 
                          class="w-full px-3 py-2 border rounded">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Image</label>
                @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="" class="w-32 mb-2">
                @endif
                <input type="file" name="image" accept="image/*" class="w-full">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Gestion des catégories - CYCO MARKET')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion des catégories</h1>
            <a href="{{ route('admin.categories.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>Nouvelle catégorie
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-2">Image</th>
                        <th class="text-left py-2">Nom</th>
                        <th class="text-left py-2">Produits</th>
                        <th class="text-left py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr class="border-b">
                        <td class="py-2">
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" 
                                     alt="{{ $category->name }}" 
                                     class="w-16 h-16 object-cover rounded">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                    <i class="fas fa-folder text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="py-2">{{ $category->name }}</td>
                        <td class="py-2">{{ $category->products()->count() }}</td>
                        <td class="py-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Clients - Administration')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="bg-gray-800 text-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-yellow-400">Liste des clients</h1>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-white">
                <thead>
                    <tr class="border-b border-gray-600">
                        <th class="text-left py-2 text-yellow-300">ID</th>
                        <th class="text-left py-2 text-yellow-300">Nom</th>
                        <th class="text-left py-2 text-yellow-300">Email</th>
                        <th class="text-left py-2 text-yellow-300">Téléphone</th>
                        <th class="text-left py-2 text-yellow-300">Dernière connexion</th>
                        <th class="text-left py-2 text-yellow-300">Statut</th>
                        <th class="text-left py-2 text-yellow-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-700">
                            <td class="py-2">{{ $user->id }}</td>
                            <td class="py-2">{{ $user->name }}</td>
                            <td class="py-2">{{ $user->email }}</td>
                            <td class="py-2">{{ $user->phone ?? '-' }}</td>
                            <td class="py-2">{{ $user->last_login ? $user->last_login->format('d/m/Y H:i') : '-' }}</td>
                            <td class="py-2">
                                @if($user->is_banned)
                                    <span class="px-2 py-1 bg-red-600 text-white rounded-full text-sm">Banni</span>
                                @else
                                    <span class="px-2 py-1 bg-green-600 text-white rounded-full text-sm">Actif</span>
                                @endif
                            </td>
                            <td class="py-2">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-blue-400 hover:text-blue-300 mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$user->is_banned)
                                    <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="inline" onsubmit="return confirm('Bannir ce client ?')">
                                        @csrf
                                        <button class="text-yellow-400 hover:text-yellow-300">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline" onsubmit="return confirm('Réactiver ce client ?')">
                                        @csrf
                                        <button class="text-green-400 hover:text-green-300">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer définitivement ce client ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:text-red-300">
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
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

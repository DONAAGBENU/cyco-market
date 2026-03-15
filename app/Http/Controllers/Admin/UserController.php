<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class);
    }

    public function index()
    {
        $users = User::where('role', 'client')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        // ensure we only show clients
        if ($user->role !== 'client') {
            abort(404);
        }

        $orders = $user->orders()->with('items.product')->latest()->get();
        return view('admin.users.show', compact('user', 'orders'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'client') {
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success', 'Client supprimé avec succès.');
        }

        return redirect()->route('admin.users.index')
            ->with('error', 'Impossible de supprimer cet utilisateur.');
    }

    public function ban(User $user)
    {
        if ($user->role === 'client') {
            $user->is_banned = true;
            $user->save();
            return redirect()->route('admin.users.index')
                ->with('success', 'Client banni.');
        }

        return redirect()->route('admin.users.index')->with('error', 'Action non autorisée.');
    }

    public function unban(User $user)
    {
        if ($user->role === 'client') {
            $user->is_banned = false;
            $user->save();
            return redirect()->route('admin.users.index')
                ->with('success', 'Client réactivé.');
        }

        return redirect()->route('admin.users.index')->with('error', 'Action non autorisée.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(\App\Http\Middleware\AdminMiddleware::class);
    }

    public function index()
    {
        // Statistiques générales
        $totalUsers = User::where('role', 'client')->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('payment_status', 'paid')->sum('total_amount');
        
        // Graphiques et données
        $recentUsers = User::where('role', 'client')->latest()->take(5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentProducts = Product::with('category')->latest()->take(5)->get();
        
        // Commandes par statut
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'recentUsers',
            'recentOrders',
            'recentProducts',
            'pendingOrders',
            'processingOrders',
            'completedOrders',
            'cancelledOrders'
        ));
    }

    // Gestion des clients
    public function clients()
    {
        $clients = User::where('role', 'client')
                       ->withCount('orders')
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);
        
        return view('admin.clients.index', compact('clients'));
    }

    public function showClient($id)
    {
        $client = User::where('role', 'client')
                      ->with(['orders' => function($q) {
                          $q->with('items.product')->latest();
                      }])
                      ->findOrFail($id);
        
        return view('admin.clients.show', compact('client'));
    }

    public function banClient($id)
    {
        $client = User::where('role', 'client')->findOrFail($id);
        $client->delete();
        
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client banni et supprimé avec succès.');
    }

    // Gestion des commandes
    public function orders()
    {
        $orders = Order::with('user')
                       ->latest()
                       ->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->back()->with('success', 'Statut de la commande mis à jour.');
    }
}
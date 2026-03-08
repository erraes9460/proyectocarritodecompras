<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Inertia\Inertia;

class OrderController extends Controller
{

    // VER HISTORIAL DE COMPRAS
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return Inertia::render('Account/Orders', [
            'orders' => $orders
        ]);
    }


    // GUARDAR PEDIDO DESDE EL CARRITO
    public function store()
    {
        $cart = session('cart');

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending'
        ]);

        foreach ($cart as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price']
            ]);

        }

        session()->forget('cart');

        return redirect()->route('client.dashboard');
    }
}
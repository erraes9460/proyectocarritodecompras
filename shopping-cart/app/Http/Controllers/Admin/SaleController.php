<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class SaleController extends Controller
{

    public function create()
    {

        $clients = User::where('role', 'cliente')->get();
        $products = Product::all();

        return inertia('Admin/Sales/Create', [
            'clients' => $clients,
            'products' => $products
        ]);

    }

    public function store(Request $request)
    {

        $total = 0;

        foreach ($request->items as $item) {

            $total += $item['price'] * $item['qty'];

        }

        $order = Order::create([
            'user_id' => $request->client_id,
            'total' => $total,
            'status' => 'completed'
        ]);

        foreach ($request->items as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'price' => $item['price']
            ]);

        }

        return redirect()->route('dashboard');

    }

}
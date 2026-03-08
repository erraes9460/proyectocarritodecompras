<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class ReportController extends Controller
{

    public function index()
    {

        $ventas = Order::sum('total');

        $productos = Product::count();

        $clientes = User::where('role', 'cliente')->count();

        $pedidos = Order::count();

        return inertia('Admin/Reports/Index', [
            'ventas' => $ventas,
            'productos' => $productos,
            'clientes' => $clientes,
            'pedidos' => $pedidos
        ]);

    }

}
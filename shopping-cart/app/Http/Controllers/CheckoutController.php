<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    // guardar carrito antes del login
    public function store(Request $request)
    {
        Session::put('cart', $request->cart);

        // si no está logueado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return redirect()->route('checkout.page');
    }

    // mostrar página checkout
    public function page()
    {
        $cart = Session::get('cart', []);

        return Inertia::render('Checkout', [
            'cart' => $cart
        ]);
    }
}
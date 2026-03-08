<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public function store(Request $request)
    {
        // guardar carrito en sesión
        Session::put('cart', $request->cart);

        // si no está logueado
        if(!auth()->check()){
            return redirect()->route('login');
        }

        // si ya está logueado ir al checkout
        return redirect()->route('checkout.page');
    }

}
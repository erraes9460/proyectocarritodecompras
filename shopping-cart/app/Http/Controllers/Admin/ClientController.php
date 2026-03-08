<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'cliente')->get();

        return inertia('Admin/Clients/Index', [
            'clients' => $clients
        ]);
    }

    public function create()
    {
        return inertia('Admin/Clients/Create');
    }

    public function store(Request $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'cliente'
        ]);

        return redirect()->route('clients.index');
    }

    public function edit($id)
    {

        $client = User::find($id);

        return inertia('Admin/Clients/Edit', [
            'client' => $client
        ]);

    }

    public function update(Request $request, $id)
    {

        $client = User::find($id);

        $client->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('clients.index');

    }

    public function destroy($id)
    {

        User::destroy($id);

        return back();

    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $clientes = Client::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        //
        $data = $request->validated();

        if(!$request->last_used_at)
            $data['last_used_at'] = "";

        $data['email'] = strtolower($data['email']);    
        $data['secret_hash'] = Str::random(32);
        $data['password'] = Hash::make($request->password);
        $data['firma'] = hash('sha256', $data['nombre'] . '|' . $data['email'] . '|' . $data['licencia_expires_at'] . '|' . $data['secret_hash']);
        Client::create($data);
        return redirect()->route('clientes.index')->with('exito', "El cliente ha sido creado con exito!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $Client)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $cliente = Client::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, $id)
    {
        //
        $cliente = Client::findOrFail($id);
        $cliente->nombre = $request->nombre;
        $cliente->email = strtolower($request->email);
        $cliente->password = Hash::make($request->password);
        $cliente->licencia_expires_at = $request->licencia_expires_at;
        $cliente->firma = hash('sha256', $cliente->nombre . '|' . $cliente->email . '|' . $cliente->licencia_expires_at . '|' . $cliente->secret_hash);
        $cliente->update();
        return redirect()->route('clientes.index')->with('exito', "El cliente ha sido actualizado con exito!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Client::destroy($id);
        return redirect()->route('clientes.index')->with('exito', "El cliente ha sido eliminado con exito!");
    }
}

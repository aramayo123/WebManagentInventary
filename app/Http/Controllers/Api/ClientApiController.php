<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;


class ClientApiController extends Controller
{
    public function desktopLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // No pedimos ambos, porque pueden venir uno u otro
        ]);
        $email = strtolower($request->email);

        $client = Client::where('email', $email)->first();

        if (!$client) {
            return response()->json(['email' => 'Cliente no encontrado'], 404);
        }

        if (!Hash::check($request->password, $client->password)) {
            return response()->json(['password' => 'Contraseña incorrecta'], 401);
        }

        return response()->json([
            'nombre' => $client->nombre,
            'email' => $client->email,
            'password' => $client->password,
            'licencia_expires_at' => $client->licencia_expires_at,
            'secret_hash' => $client->secret_hash,
            'last_used_at' => $client->last_used_at,
            'ip_sesion' => $client->ip_sesion,
            'firma' => $client->firma,
        ], 200);
    }

    public function updateLastUsed(Request $request)
    {
        $email = strtolower($request->input('email'));
        $newip = $request->input('ip_sesion');
        if (! $email) {
            return response()->json(['error' => 'Email requerido'], 400);
        }
        if (! $newip) {
            return response()->json(['error' => 'Nueva ip requerida'], 400);
        }
        $client = Client::where('email', $email)->first();
        if(!$client)
            return response()->json(['error' => 'Cliente no encontrado'], 404);
    
        $client->last_used_at = now();
        $client->ip_sesion = $newip;
        $client->update();
        return response()->json(['success' => true], 200);
    }
    public function updateLogout(Request $request)
    {
        $email = strtolower($request->input('email'));
        if (! $email) {
            return response()->json(['error' => 'Email requerido'], 400);
        }
        $client = Client::where('email', $email)->first();
        if(!$client)
            return response()->json(['error' => 'Cliente no encontrado'], 404);
    
        $client->ip_sesion = "";
        $client->update();
        return response()->json(['success' => true], 200);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\Client;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        try {
            return Client::all();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al obtener la lista de clientes',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            return Client::findOrFail($id);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al obtener el cliente',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->get('query');
            return Client::where('nombres', 'like', "%{$query}%")->get();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al buscar clientes',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'fecha_nacimiento' => 'required|date',
                'cuit' => 'required|string|unique:clients',
                'domicilio' => 'required|string',
                'telefono_celular' => 'required|string',
                'email' => 'required|email|unique:clients',
            ]);

            return Client::create($validated);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al guardar el cliente',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $client = Client::findOrFail($id);

            $validated = $request->validate([
                'nombres' => 'required|string',
                'apellidos' => 'required|string',
                'fecha_nacimiento' => 'required|date',
                'cuit' => ['required', 'string', Rule::unique('clients')->ignore($client->id)],
                'domicilio' => 'required|string',
                'telefono_celular' => 'required|string',
                'email' => ['required', 'email', Rule::unique('clients')->ignore($client->id)],
            ]);

            $client->update($validated);
            return $client;
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al actualizar el cliente',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getAll()
    {
        try {
            $clients = Client::all();
            return response()->json($clients, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al obtener los datos de los clientes',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function get($id)
    {
        try {
            $client = Client::find($id);
            if (!$client) {
                return response()->json(['message' => 'Cliente no encontrado'], 404);
            }
            return response()->json($client, 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al obtener el cliente',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

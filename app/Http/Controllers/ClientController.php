<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Affiche la liste des clients
     */
    public function index()
    {
        // Récupère tous les clients avec leur devise préférée
        $clients = Client::with('preferredCurrency')->get();
        return response()->json($clients);
    }

    /**
     * Crée un nouveau client
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'phone' => 'nullable|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state_province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'tax_number' => 'nullable|string|max:50',
            'preferred_currency_id' => 'required|exists:currencies,id',
            'preferred_language' => 'required|string|max:10',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Création du client
        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    /**
     * Affiche un client spécifique
     */
    public function show($id)
    {
        $client = Client::with('preferredCurrency')->findOrFail($id);
        return response()->json($client);
    }

    /**
     * Met à jour un client
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        // Validation des données
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'address_line_1' => 'sometimes|required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'sometimes|required|string|max:100',
            'state_province' => 'sometimes|required|string|max:100',
            'postal_code' => 'sometimes|required|string|max:20',
            'country' => 'sometimes|required|string|max:100',
            'tax_number' => 'nullable|string|max:50',
            'preferred_currency_id' => 'sometimes|required|exists:currencies,id',
            'preferred_language' => 'sometimes|required|string|max:10',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $client->update($request->all());

        return response()->json($client);
    }

    /**
     * Supprime un client
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Affiche la liste des factures
     */
    public function index()
    {
        // Récupère toutes les factures avec les relations
        $invoices = Invoice::with(['client', 'user', 'currency', 'originalCurrency'])->get();
        return response()->json($invoices);
    }

    /**
     * Crée une nouvelle facture
     */
    public function store(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'invoice_number' => 'required|string|unique:invoices',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'currency_id' => 'required|exists:currencies,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'status' => 'required|in:draft,sent,paid,overdue,cancelled',
            'subtotal' => 'required|numeric|min:0',
            'tax_amount' => 'required|numeric|min:0',
            'discount_amount' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'line_items' => 'required|json',
            'original_currency_id' => 'required|exists:currencies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Création de la facture
        $invoice = Invoice::create($request->all());

        return response()->json($invoice, 201);
    }

    /**
     * Affiche une facture spécifique
     */
    public function show($id)
    {
        $invoice = Invoice::with(['client', 'user', 'currency', 'originalCurrency'])->findOrFail($id);
        return response()->json($invoice);
    }

    /**
     * Met à jour une facture
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        // Validation des données
        $validator = Validator::make($request->all(), [
            'invoice_number' => 'sometimes|required|string|unique:invoices,invoice_number,' . $invoice->id,
            'client_id' => 'sometimes|required|exists:clients,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'currency_id' => 'sometimes|required|exists:currencies,id',
            'issue_date' => 'sometimes|required|date',
            'due_date' => 'sometimes|required|date|after_or_equal:issue_date',
            'status' => 'sometimes|required|in:draft,sent,paid,overdue,cancelled',
            'subtotal' => 'sometimes|required|numeric|min:0',
            'tax_amount' => 'sometimes|required|numeric|min:0',
            'discount_amount' => 'sometimes|required|numeric|min:0',
            'total_amount' => 'sometimes|required|numeric|min:0',
            'notes' => 'nullable|string',
            'terms_and_conditions' => 'nullable|string',
            'line_items' => 'sometimes|required|json',
            'original_currency_id' => 'sometimes|required|exists:currencies,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $invoice->update($request->all());

        return response()->json($invoice);
    }

    /**
     * Supprime une facture
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(null, 204);
    }
}
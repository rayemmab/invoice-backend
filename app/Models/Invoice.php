<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_number',
        'client_id',
        'user_id',
        'currency_id',
        'issue_date',
        'due_date',
        'status',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'notes',
        'terms_and_conditions',
        'line_items',
        'original_currency_id',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'line_items' => 'json',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Relation avec le client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relation avec l'utilisateur qui a créé la facture
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la devise de la facture
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Relation avec la devise originale
     */
    public function originalCurrency()
    {
        return $this->belongsTo(Currency::class, 'original_currency_id');
    }
}
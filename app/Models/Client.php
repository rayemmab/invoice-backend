<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'state_province',
        'postal_code',
        'country',
        'tax_number',
        'preferred_currency_id',
        'preferred_language',
        'notes',
    ];

    /**
     * Relation avec la devise préférée
     */
    public function preferredCurrency()
    {
        return $this->belongsTo(Currency::class, 'preferred_currency_id');
    }

    /**
     * Relation avec les factures
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
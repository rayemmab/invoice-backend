<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'symbol',
        'rate',
        'decimal_places',
        'is_default',
        'last_updated_at',
    ];

    /**
     * Les attributs qui doivent être convertis en types natifs.
     *
     * @var array
     */
    protected $casts = [
        'rate' => 'decimal:6',
        'is_default' => 'boolean',
        'last_updated_at' => 'datetime',
    ];

    /**
     * Relation avec les clients qui ont cette devise comme préférée
     */
    public function clients()
    {
        return $this->hasMany(Client::class, 'preferred_currency_id');
    }

    /**
     * Relation avec les factures
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'currency_id');
    }
}
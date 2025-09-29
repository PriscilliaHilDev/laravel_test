<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    /**
     * Les colonnes que l'on autorise au remplissage.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'property_id',
        'start_date',
        'end_date',
    ];

    /**
     * Relation : une réservation appartient à un utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : une réservation appartient à un bien.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
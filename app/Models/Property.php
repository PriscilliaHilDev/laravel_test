<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * Colonnes autorisées au remplissage.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'image', // si tu ajoutes un champ image
    ];

    /**
     * Relation : un bien peut avoir plusieurs réservations.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

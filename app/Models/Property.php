<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
     use HasFactory;

    // Colonnes que l'on autorise au remplissage
    protected $fillable = [
        'name',
        'description',
        'price_per_night',
    ];

    // Relations
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
     use HasFactory;

    // Colonnes que l'on autorise au remplissage
    protected $fillable = [
        'user_id',
        'property_id',
        'start_date',
        'end_date',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
